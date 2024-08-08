<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use App\Models\Comment;
class PostCommentsController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_post_comments,show_post_comments')){
            return redirect('admin/index');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $postId = (isset(\request()->post_id) && \request()->post_id != '') ? \request()->post_id : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';


        $comments = Comment::query();
        if($keyword !=null){
            $comments = $comments->search($keyword);
        }
        if($postId !=null) {
            $comments = $comments->wherePostId($postId);
        }
        if($status !=null) {
            $comments = $comments->whereStatus($status);
        }

        $comments= $comments->orderBy($sort_by, $order_by);
        $comments= $comments->paginate($limit_by);

        $posts = Post::post()->pluck('title', 'id');
        return view('backend.post_comments.index', compact('comments', 'posts' ));
    }

    public function create()
    {
//
    }

    public function store(Request $request)
    {
      //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_post_comments')){
            return redirect('admin/index');
        }

        $comment = Comment::whereId($id)->first();
        return view('backend.post_comments.edit', compact('comment') );

    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_post_comments')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'url' => 'nullable|url',
            'status' => 'required',
            'comment' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = Comment::whereId($id)->first();
        if($comment) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['url'] = $request->url;
            $data['status'] = $request->status;
            $data['comment'] = Purify::clean($request->comment);

            $comment->update($data);

            Cache::forget('recent_comments');

            return redirect()->route('admin.post_comments.index')->with([
                'message' => 'Comment Updated Successfully',
                'alert-type' => 'success',
            ]);

            return redirect()->route('admin.post_comments.index')->with([
                'message' => 'Something was wrong please try again later',
                'alert-type' => 'danger',
            ]);
        }
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_post_comments')){
            return redirect('admin/index');
        }
        $comment = Comment::whereId($id)->first();
        if($comment)
        {
            $comment->delete();
            return  redirect()->route('admin.post_comments.index')->with([
                'message' => 'Comment Deleted Successfully',
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.post_comments.index')->with([
            'message' => 'Something was wrong. Comment Not Found',
            'alert-type' => 'danger',
        ]);


    }

}
