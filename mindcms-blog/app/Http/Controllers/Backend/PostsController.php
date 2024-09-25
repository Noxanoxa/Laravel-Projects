<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class PostsController extends Controller
{

    public function __construct() {
        if(\auth()->check()){
            $this->middleware('auth');
        }
        else {
            return view('backend.auth.login');
        }
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_posts,show_posts')){
            return redirect('admin/index');
        }

        $posts = Post::with(['media', 'user', 'comments'])->post()
        ->when(request('keyword') != '', function ($query){
            $query->search(request('keyword'));
        })
        ->when(request('category_id') != '', function ($query){
                $query->whereCategoryId(request('category_id'));
            })
        ->when(request('tag_id') != '', function ($query){
                $query->whereHas('tags', function ($q) {
                    $q->where('id', request('tag_id'));
                });
            })
        ->when(request('status') != '', function ($query){
                $query->whereStatus(request('status'));
            })
        ->orderBy(request('sort_by') ??  'id', request('order_by') ??  'desc')
        ->paginate(request('limit_by')?? '10')
        ->withQueryString();


        $tags = Tag::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        $categories= Category::orderBy('id', 'desc')->select('id', 'name',  'name_en')->get();
        return view('backend.posts.index', compact('posts', 'categories', 'tags'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_posts')){
            return redirect('admin/index');
        }
        $tags = Tag::select('name', 'id');
        $categories= Category::orderBy('id', 'desc')->select('name', 'id');
        return view('backend.posts.create', compact('categories', 'tags'));

    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_posts')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'description'    => 'required|min:50',
            'status'         => 'required',
            'comment_able'   => 'required',
            'category_id'    => 'required',
            'images.*'       => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
            'tags.*'         => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data ['title']                   = $request->title;
        $data ['description']             = Purify::clean($request->description);
        $data ['status']                  = $request->status;
        $data ['post_type']                  = 'post';
        $data ['comment_able']            = $request->comment_able;
        $data ['category_id']             = $request->category_id;

        $post = auth()->user()->posts()->create($data);

        if($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $filename = $post->slug . '-' . time() . '-' . $i . '.'
                            . $file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('assets/posts/' . $filename);
                Image::make($file->getRealPath())->resize(
                    800,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save($path, 100);

                $post->media()->create([
                    'file_name' => $filename,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }

        if(count($request->tags) > 0) {
            $new_tags = [];
            foreach ($request->tags as $tag) {
                $tag = Tag::firstOrCreate([
                    'id' => $tag
                ], [
                    'name' => $tag
                ]);
                $new_tags[] = $tag->id;
            }
            $post->tags()->sync($new_tags);
        }

            if($request->status == 1) {
                Cache::forget('recent_posts');
                Cache::forget('global_tags');
            }

            return redirect()->route('admin.posts.index')->with([
                'message' => 'Post Created Successfully',
                'alert-type' => 'success',
            ]);
    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_posts')){
            return redirect('admin/index');
        }
        $post = Post::with(['media', 'user', 'category', 'comments'])->whereId($id)->post()->first();
        return view('backend.posts.show', compact( 'post') );

    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_posts')){
            return redirect('admin/index');
        }
        $tags = Tag::select('id', 'name', 'name_en')->get();
        $categories = Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        $post = Post::with(['media'])->whereId($id)->post()->first();
        return view('backend.posts.edit', compact('categories', 'post', 'tags'));

    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_posts')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'description'    => 'required|min:50',
            'status'         => 'required',
            'comment_able'   => 'required',
            'category_id'    => 'required',
            'images.*'       => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
            'tags.*'         => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::whereId($id)->post()->first();
        if($post) {
            $data ['title']                   = $request->title;
            $data ['slug']                   = null;
            $data ['description']             = Purify::clean($request->description);
            $data ['status']                  = $request->status;
            $data ['comment_able']            = $request->comment_able;
            $data ['category_id']             = $request->category_id;

            $post->update($data);

            if($request->images && count($request->images) > 0) {
                $i = 1;
                foreach($request->images as $file) {
                    $filename   = $post->slug.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size  = $file->getSize();
                    $file_type  = $file->getMimeType();
                    $path       = public_path('assets/posts/'. $filename);
                    Image::make($file->getRealPath())->resize(800, null, function($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $post->media()->create([
                        'file_name' => $filename,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                    ]);
                    $i++;
                }
            }

            if(count($request->tags) > 0) {
                $new_tags = [];
                foreach ($request->tags as $tag) {
                    $tag = Tag::firstOrCreate([
                        'id' => $tag
                    ], [
                        'name' => $tag
                    ]);
                    $new_tags[] = $tag->id;
                }
                $post->tags()->sync($new_tags);
            }

            return redirect()->route('admin.posts.index')->with([
                'message' => 'Post Updated Successfully',
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.posts.index')->with([
            'message' => 'Something was wrong please try again later',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_posts')){
            return redirect('admin/index');
        }
        $post = Post::whereId($id)->post()->first();
        if($post)
        {
            if($post->media->count() >0) {
                foreach($post->media as $media) {
                    if(File::exists('assets/posts/'. $media->file_name)){
                        unlink('assets/posts/'. $media->file_name);
                    }
                }
            }

            $post->delete();

            return  redirect()->route('admin.posts.index')->with([
                'message' => 'Post Deleted Successfully',
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.posts.index')->with([
            'message' => 'Something was wrong. Post Not Found',
            'alert-type' => 'danger',
        ]);


    }

    public function removeImage(Request $request){
        if (!\auth()->user()->ability('admin', 'delete_posts')){
            return redirect('admin/index');
        }
        $media = PostMedia::whereId($request->media_id)->first();
        if($media){
            if(File::exists('assets/posts/'.$media->file_name)) {
                unlink('assets/posts/'.$media->file_name);
            }
            $media->delete();
            return true;
        }
        return false;
    }
}
