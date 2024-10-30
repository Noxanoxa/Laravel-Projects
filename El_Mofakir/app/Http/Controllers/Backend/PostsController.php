<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Tag;
use App\Models\User;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use ZipArchive;

class PostsController extends Controller
{

    public function __construct()
    {
        if (\auth()->check()) {
            $this->middleware('auth');
        } else {
            return view('backend.auth.login');
        }
    }

    public function index()
    {
        if ( ! \auth()->user()->ability('admin', 'manage_posts,show_posts')) {
            return redirect('admin/index');
        }

        $filters    = request()->only(
            [
                'keyword',
                'volume_id',
                'issue_id',
                'category_id',
                'tag_id',
                'status',
                'sort_by',
                'order_by',
            ]
        );
        $pagination = request()->only(['limit_by']);

        $posts = Post::getPosts($filters, $pagination);

        $tags       = Tag::orderBy('id', 'desc')->select(
            'id',
            'name',
            'name_en'
        )->get();
        $categories = Category::orderBy('id', 'desc')->select(
            'id',
            'name',
            'name_en'
        )->get();
        $volumes    = Volume::orderBy('id', 'desc')->select('id', 'number')
                            ->get();

        return view(
            'backend.posts.index',
            compact('posts', 'categories', 'tags', 'volumes')
        );
    }

    public function create()
    {
        if ( ! \auth()->user()->ability('admin', 'create_posts')) {
            return redirect('admin/index');
        }
        $tags       = Tag::select('id', 'name', 'name_en')->get();
        $categories = Category::orderBy('id', 'desc')->select(
            'id',
            'name',
            'name_en'
        )->get();
        $authors = User::whereRelation('roles', 'name', 'user')->orderBy('id', 'desc')->select('id', 'name')
                    ->get();

        return view('backend.posts.create', compact('categories', 'tags', 'authors'));
    }

    public function store(Request $request)
    {
        if ( ! \auth()->user()->ability('admin', 'create_posts')) {
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en'       => 'required',
            'description'    => 'required|min:50',
            'description_en' => 'required|min:50',
            'status'         => 'required',
            'category_id'    => 'required',
            'pdf.*'          => 'nullable|mimes:pdf|max:20000',
            'tags.*'         => 'nullable',
            'published_at'     => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::createPost($request->all(), auth()->user());

        if ($request->hasFile('pdf')) {
            $post->addMedia($request->file('pdf'));
        }

        if (count($request->tags) > 0) {
            $post->syncTags($request->tags);
        }

        if (is_array($request->authors) && count($request->authors) > 0) {
            $post->authors()->sync($request->authors);
        }

        if ($request->status == 1) {
            Cache::forget('recent_posts');
            Cache::forget('global_tags');
        }

        return redirect()->route('admin.posts.index')->with([
            'message'    => __('messages.post_created_successfully'),
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        if ( ! \auth()->user()->ability('admin', 'display_posts')) {
            return redirect('admin/index');
        }
        $post = Post::with(['media', 'user', 'category'])->whereId($id)->post()
                    ->first();
        $authors = $post->authors()->pluck('name')->toArray();

        return view('backend.posts.show', compact('post', 'authors'));
    }

    public function edit($id)
    {
        if ( ! \auth()->user()->ability('admin', 'update_posts')) {
            return redirect('admin/index');
        }
        $tags       = Tag::select('id', 'name', 'name_en')->get();
        $categories = Category::orderBy('id', 'desc')->select(
            'id',
            'name',
            'name_en'
        )->get();
        $authors    = User::whereRelation('roles', 'name', 'user')->orderBy('id', 'desc')->select('id', 'name')
                    ->get();
        $post       = Post::with('media')->whereId($id)->post()->first();

        return view(
            'backend.posts.edit',
            compact('categories', 'post', 'tags', 'authors')
        );
    }

    public function update(Request $request, $id)
    {
        if ( ! \auth()->user()->ability('admin', 'update_posts')) {
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en'       => 'required',
            'description'    => 'required|min:50',
            'description_en' => 'required|min:50',
            'status'         => 'required',
            'category_id'    => 'required',
            'pdf.*'          => 'nullable|mimes:pdf|max:20000',
            'tags.*'         => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::whereId($id)->post()->first();
        if ($post) {
            $post->updatePost($request->all());

            if ($request->hasFile('pdf')) {
                $post->addMedia($request->file('pdf'));
            }

            if (is_array($request->tags) && count($request->tags) > 0) {
                $post->syncTags($request->tags);
            } else {
                $post->tags()->detach();
            }
            if (is_array($request->authors) && count($request->authors) > 0) {
                $post->authors()->sync($request->authors);
            } else {
                $post->authors()->detach();
            }

            return redirect()->route('admin.posts.index')->with([
                'message'    => __('messages.post_updated_successfully'),
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.posts.index')->with([
            'message'    => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {
        if ( ! \auth()->user()->ability('admin', 'delete_posts')) {
            return redirect('admin/index');
        }
        $post = Post::whereId($id)->post()->first();
        if ($post) {
            $post->removeMedia();
            $post->delete();

            return redirect()->route('admin.posts.index')->with([
                'message'    => __('messages.post_deleted_successfully'),
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.posts.index')->with([
            'message'    => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function removePdf(Request $request)
    {
        if ( ! \auth()->user()->ability('admin', 'delete_posts')) {
            return redirect('admin/index');
        }
        $media = PostMedia::whereId($request->media_id)->first();
        if ($media) {
            if (File::exists('assets/posts/' . $media->file_name)) {
                unlink('assets/posts/' . $media->file_name);
            }
            $media->delete();

            return true;
        }

        return false;
    }

    public function downloadAllPdfs($postId)
    {
        $post     = Post::findOrFail($postId);
        $pdfFiles = $post->media()->where('file_type', 'application/pdf')->get(
        );

        if ($pdfFiles->isEmpty()) {
            return redirect()->back()->with(
                'error',
                __('messages.no_pdf_files')
            );
        }

        $zip         = new ZipArchive();
        $zipFileName = $postId->real_file_name . '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach ($pdfFiles as $file) {
                $filePath = public_path('assets/posts/' . $file->file_name);
                $zip->addFile($filePath, $file->file_name);
            }
            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

}
