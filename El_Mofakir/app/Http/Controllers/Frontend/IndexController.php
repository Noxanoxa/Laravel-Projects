<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Notification;




class IndexController extends Controller
{
/*    public function index()
    {
        $posts = Post::with([ 'media', 'user', 'tags'])
                    ->whereHas('category', function($query) {
                        $query->whereStatus('1');
                    })
                    ->whereHas('user', function($query) {
                        $query->whereStatus('1');
                    })
                     ->post()->active()->orderBy('id', 'desc')->paginate(5);

        return view('frontend.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $keyword = isset($request->keyword) && $request->keyword != '' ? $request->keyword : null;


        $posts = Post::with(['media', 'user', 'tags'])
                     ->whereHas('category', function($query) {
                         $query->whereStatus('1');
                     })
                     ->whereHas('user', function($query) {
                         $query->whereStatus('1');
                     });

        if($keyword != null)
        {
            $posts = $posts->search($keyword, null, true);
        }

        $posts = $posts ->post()->active()->orderBy('id', 'desc')->paginate(5);

        return view('frontend.index', compact('posts'));



    }

    public function post_show($slug)
    {
        $post = Post::with(['category', 'media', 'user', 'tags' => function($query) {
            $query->orderBy('id', 'desc');
        }]);

        $post = $post->whereHas('category', function($query) {
                $query->whereStatus('1');
            })
            ->whereHas('user', function($query) {
                $query->whereStatus('1');
            });

//        dd($post);
        $post = Post::where('slug_en', $slug);
        $post = $post->active()->first();

        if($post) {

            $blade = $post->post_type == 'post' ?  'post' : 'page';
            return view('frontend.'. $blade, compact('post'));

        } else {
            return redirect()->route('frontend.index');
        }

    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function do_contact(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable|numeric',
            'title' => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['mobile']     = $request->mobile;
        $data['title']      = $request->title;
        $data['message']    = $request->message;


        Contact::create($data);

        return redirect()->back()->with([
            'message' => 'Your Message Sent Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function category($slug)
    {
    $category = Category::whereSlug($slug)->orWhere('id', $slug)->whereStatus(1)->first()->id;
    if($category) {
        $posts = Post::with([ 'media', 'user', 'tags'])
            ->whereCategoryId($category)
            ->post()
            ->active()
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('frontend.index', compact('posts'));
    }
    return redirect()->route('frontend.index');
    }

    public function archive($date)
    {
        // 06-2024
        $exploded_date = explode('-', $date);
        $month = $exploded_date[0];
        $year = $exploded_date[1];

        $posts = Post::with(['media', 'user', 'tags'])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->post()
            ->active()
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('frontend.index', compact('posts'));

    }

    public function author($username)
    {
        $author = User::whereUsername($username)->orWhere('id', $username)->whereStatus(1)->first()->id;
        if($author) {
            $posts = Post::with(['media', 'user', 'tags'])
                         ->whereUserId($author)
                         ->post()
                         ->active()
                         ->orderBy('id', 'desc')
                         ->paginate(5);
            return view('frontend.index', compact('posts'));
        }
        return redirect()->route('frontend.index');
    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->orWhere('id', $slug)->first()->id;
        if($tag) {
            $posts = Post::with([ 'media', 'user', 'tags'])
                         ->whereHas('tags', function ($query) use($slug){
                                $query->where('slug', $slug);
                         })
                         ->post()
                         ->active()
                         ->orderBy('id', 'desc')
                         ->paginate(5);
            return view('frontend.index', compact('posts'));
        }
        return redirect()->route('frontend.index');
    }*/
}

