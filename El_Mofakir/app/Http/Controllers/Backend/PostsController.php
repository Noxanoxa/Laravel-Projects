<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Tag;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use ZipArchive;


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

        $posts = Post::with(['media', 'user'])->post()
        ->when(request('keyword') != '', function ($query){
            $query->search(request('keyword'));
        })

                ->when(request('volume_id') != '', function ($query){
                $query->whereVolumeId(request('volume_id'));
            })

                ->when(request('issue_id') != '', function ($query){
                $query->whereIssueId(request('issue_id'));
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
        $volumes = Volume::orderBy('id', 'desc')->select('id', 'number')->get();
        return view('backend.posts.index', compact('posts', 'categories', 'tags', 'volumes'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_posts')){
            return redirect('admin/index');
        }
        $tags = Tag::select('id', 'name', 'name_en')->get();
        $categories = Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        return view('backend.posts.create', compact('categories', 'tags'));

    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_posts')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en' => 'required',
            'description'    => 'required|min:50',
            'description_en' => 'required|min:50',
            'status'         => 'required',
            'category_id'    => 'required',
            'pdf.*'          => 'nullable|mimes:pdf|max:20000',
            'tags.*'         => 'required',
        ]);

        if($validator->fails()) {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data ['title']                   = $request->title;
        $data ['title_en']                   = $request->title_en;
        $data ['description']             = Purify::clean($request->description);
        $data ['description_en']             = Purify::clean($request->description_en);
        $data ['status']                  = $request->status;
        $data ['post_type']                  = 'post';
        $data ['category_id']             = $request->category_id;

        $post = auth()->user()->posts()->create($data);

        // Handle PDF upload
        if ($request->hasFile('pdf')) {
            foreach ($request->file('pdf') as $file) {
                $filename = $post->slug . '-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $file->move(public_path('assets/posts'), $filename);

                $post->media()->create([
                    'post_id' => $post->id,
                    'file_name' => $filename,
                    'real_file_name' => $file->getClientOriginalName(), // Save the real file name
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
            }
        }


        if(count($request->tags) > 0) {
            $new_tags = [];
            foreach ($request->tags as $tag) {
                $tag = Tag::firstOrCreate([
                    'id' => $tag
                ], [
                    'name' => $tag,
                    'name_en' => $tag,
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
        $post = Post::with(['media', 'user', 'category'])->whereId($id)->post()->first();

        return view('backend.posts.show', compact( 'post') );

    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_posts')){
            return redirect('admin/index');
        }
        $tags = Tag::select('id', 'name', 'name_en')->get();
        $categories = Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        $post = Post::with('media')->whereId($id)->post()->first();
        return view('backend.posts.edit', compact('categories', 'post', 'tags'));

    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_posts')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en' => 'required',
            'description'    => 'required|min:50',
            'description_en' => 'required|min:50',
            'status'         => 'required',
            'category_id'    => 'required',
            'pdf.*' => 'nullable|mimes:pdf|max:20000',
            'tags.*'         => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::whereId($id)->post()->first();
        if($post) {
            $data ['title']                   = $request->title;
            $data ['title_en']                   = $request->title_en;
            $data ['slug']                   = null;
            $data ['slug_en']                   = null;
            $data ['description']             = Purify::clean($request->description);
            $data ['description_en']             = Purify::clean($request->description_en);
            $data ['status']                  = $request->status;
            $data ['category_id']             = $request->category_id;

            $post->update($data);

            // Handle PDF upload
            // Handle PDF upload
            if ($request->hasFile('pdf')) {

                // Store new PDFs
                foreach ($request->file('pdf') as $file) {
                    $filename = $post->slug . '-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $file->move(public_path('assets/posts'), $filename);


                    // Save PDF info to database
                    $post->media()->create([
                        'file_name' => $filename,
                        'real_file_name' => $file->getClientOriginalName(), // Save the real file name
                        'file_type' => $file_type,
                        'file_size' => $file_size
                    ]);
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

    public function removePdf(Request $request){
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

    public function downloadAllPdfs($postId)
    {
        $post = Post::findOrFail($postId);
        $pdfFiles = $post->media()->where('file_type', 'application/pdf')->get();

        if ($pdfFiles->isEmpty()) {
            return redirect()->back()->with('error', 'No PDFs found for this post.');
        }

        $zip = new ZipArchive;
        $zipFileName = $postId->real_file_name. '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($pdfFiles as $file) {
                $filePath = public_path('assets/posts/' . $file->file_name);
                $zip->addFile($filePath, $file->file_name);
            }
            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
