<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UsersCategoriesResource;
use App\Http\Resources\Users\UsersPostCommentsResource;
use App\Http\Resources\Users\UsersPostResource;
use App\Http\Resources\Users\UsersPostsResource;
use App\Http\Resources\Users\UsersTagsResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function user_information() {
        $user = Auth::user();
        return response()->json(['errors' => false, 'message' =>new UserResource($user)], 200);
    }

    public function getNotifications()
    {
        return [
            'read'      => auth()->user()->readNotifications,
            'unread'    => auth()->user()->unreadNotifications,
        ];
    }

    public function markAsRead(Request $request)
    {
        return auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }

    public function  update_user_information(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'bio' => 'nullable|min:10',
            //            'receive_email' => 'required|in:0,1',
            'receive_email' => 'required',
            'user_image' => 'nullable|image|max:20000|mimes:jpeg,jpg,png',
        ]);
        if($validation->fails())
        {
            return response()->json(['errors' => true, 'message' => $validation->errors()], 201);
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['bio'] = $request->bio;
        $data['receive_email'] = $request->receive_email;
        if($image = $request->file('user_image'))
        {
            if(auth()->user()->user_image != '')
            {
                if(File::exists('assets/users/'.auth()->user()->user_image))
                {
                    unlink('assets/users/'.auth()->user()->user_image);
                }
            }
            $filename = Str::slug(auth()->user()->username) . '.'. $image->getClientOriginalName();
            $path = public_path('assets/users/'. $filename);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);

            $data['user_image'] = $filename;
        }
        $update = auth()->user()->update($data);
        if($update)
        {
            return response()->json(['errors' => false, 'message' => 'User Information Updated Successfully'], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'Something was wrong'], 201);
        }
    }

    public function update_user_password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if($validation->fails())
        {
            return response()->json(['errors' => true, 'message' => $validation->errors()], 201);
        }

        $user = auth()->user();
        if(Hash::check($request->current_password, $user->password)){
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);
            if($update)
            {
                return response()->json(['errors' => false, 'message' => 'Password Updated Successfully'], 200);
            } else {
                return response()->json(['errors' => true, 'message' => 'Something was wrong'], 201);
            }
        } else
        {
            return response()->json(['errors' => true, 'message' => 'Current Password is wrong'], 201);
        }




    }


/*    public function details() {
        $user = Auth::user();
        return response()->json($user, 200);
    }*/

    public function my_posts()
    {
        $user = Auth::user();
        $posts = $user->posts;
        return UsersPostsResource::collection($posts);
    }

    public function create_post()
    {
        $tags = Tag::all();
        $categories = Category::active()->get();
        return ['tags'=> UsersTagsResource::collection($tags), 'categories'=> UsersCategoriesResource::collection($categories)];
    }

    public function store_post(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'description'    => 'required|min:50',
            'status'         => 'required',
            'comment_able'   => 'required',
            'category_id'    => 'required',
            'tags.*'    => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => true, 'messages' => $validator->errors()], 201);
        }

        $data ['title']                   = $request->title;
        $data ['description']             = Purify::clean($request->description);
        $data ['status']                  = $request->status;
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
                    'id' => $tag,
                ], [
                    'name' => $tag,
                ]);
                $new_tags[] = $tag->id;
            }
            $post->tags()->sync($new_tags);
        }

        if($request->status == 1) {
            Cache::forget('recent_posts');
            Cache::forget('global_tags');
        }

        return response()->json(['errors' => false, 'message' => 'Post created successfully'], 200);

    }

    public function edit_post($post)
    {
        $post = Post::whereSlug($post)->orWhere('id', $post)->whereUserId(auth()->id())->first();
        $tags = Tag::all();
        $categories = Category::active()->get();
        return ['post' => new UsersPostResource($post), 'tags'=> UsersTagsResource::collection($tags), 'categories'=> UsersCategoriesResource::collection($categories)];
    }

    public function update_post(Request $request, $post)
    {
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'description'    => 'required|min:50',
            'status'         => 'required',
            'comment_able'   => 'required',
            'category_id'    => 'required',
            'tags.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => true, 'messages' => $validator->errors()], 201);
        }
        $post = Post::whereSlug($post)->orWhere('id', $post)->whereUserId(auth()->id())->first();
        if($post) {
            $data ['title']                   = $request->title;
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
                        'id' => $tag,
                    ], [
                        'name' => $tag,
                    ]);
                    $new_tags[] = $tag->id;
                }
                $post->tags()->sync($new_tags);
            }

            return response()->json(['errors' => false, 'message' => 'Post Updated Successfully'], 200);

        }
        return response()->json(['errors' => true, 'message' => 'Unauthorized'], 201);// 201 instead 401 for mobile app developers

    }

    public function delete_post($post_id)
    {
        $post = Post::whereSlug($post_id)->orWhere('id', $post_id)->whereUserId(auth()->id())->first();
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

            return  response()->json(['errors' => false, 'message' => 'Post Deleted Successfully'], 200);
        }
        return response()->json(['errors' => true, 'message' => 'Something was wrong'], 201);// 201 instead 401 for mobile app developers
    }
    public function destroy_post_media($media_id)
    {
        $media = PostMedia::whereId($media_id)->first();
        if($media){
            if(File::exists('assets/posts/'.$media->file_name)) {
                unlink('assets/posts/'.$media->file_name);
            }
            $media->delete();
            return response()->json(['errors' => false, 'message' => 'Media Deleted Successfully'], 200);
        }
        return response()->json(['errors' => true, 'message' => 'Something was wrong'], 201);// 201 instead 401 for mobile app developers
    }

    public function all_comments(Request $request)
    {
        $commentsQuery = Comment::query();
        if (isset($request->post) && $request->post != '') {
            $commentsQuery = $commentsQuery->where('post_id', $request->post);
        } else {
            $posts_id = auth()->user()->posts->pluck('id')->toArray();
            $commentsQuery = $commentsQuery->whereIn('post_id', $posts_id);
        }
        $comments = $commentsQuery->orderBy('id', 'desc');
        $comments = $comments->get();

        return response()->json(UsersPostCommentsResource::collection($comments),  200);
    }

    public function edit_comment($id)
    {
        $comment = Comment::whereId($id)->WhereHas('post', function ($query){
            $query->where('posts.user_id', auth()->id() );
        })->first();
        if($comment) {
            return response()->json(['errors' => false, 'message' => new UsersPostCommentsResource($comment)], 200);
        } else
        {
            return response()->json(['errors' => true, 'message' => 'Something was wrong'], 201);// 201 instead 401 for mobile app developers
        }
    }

    public function update_comment(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'url' => 'nullable|url',
            'status' => 'required',
            'comment' => 'required',
        ]);
        if($validation->fails()) {
            return response()->json(['errors' => true, 'message' => $validation->errors()], 201);// 201 instead 401 for mobile app developers
        }
        $comment = Comment::whereId($id)->WhereHas('post', function ($query){
            $query->where('posts.user_id', auth()->id() );
        })->first();
        if($comment) {
            $data['name']       = $request->name;
            $data['email']      = $request->email;
            $data['url']        = $request->url != '' ? $request->url : null;
            $data['status']     = $request->status;
            $data['comment']    = Purify::clean($request->comment);

            $comment->update($data);
            if($request->status == 1) {
                Cache::forget('recent_comments');
            }
            return response()->json(['errors' => false, 'message' => 'Comment Updated Successfully'], 200);
        }
        return response()->json(['errors' => true, 'message' => 'Something was wrong'], 201);// 201 instead 401 for mobile app developers

    }

    public function delete_comment($id)
    {
        $comment = Comment::whereId($id)->WhereHas('post', function ($query){
            $query->where('posts.user_id', auth()->id() );
        })->first();
        if($comment) {
            $comment->delete();
            Cache::forget('recent_comments');
            return response()->json(['errors' => false, 'message' => 'Comment Deleted Successfully'], 200);
        }
        return response()->json(['errors' => true, 'message' => 'Something was wrong. Comment Not Found'], 201);// 201 instead 401 for mobile app developers
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['errors' => false, 'message' => 'Successfully logged out']);
    }

}
