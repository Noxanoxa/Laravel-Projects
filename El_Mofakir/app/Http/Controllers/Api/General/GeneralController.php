<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\AnnouncementsResource;
use App\Http\Resources\General\PageResource;
use App\Http\Resources\General\PostResource;
use App\Http\Resources\General\TagsResource;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\General\PostsResource;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\NewCommentForAdminNotify;
use App\Notifications\NewCommentForPostOwnerNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use ZipArchive;

class GeneralController extends Controller
{

    public function get_posts()
    {
        $posts = Post::whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
                     ->whereHas('user', function ($query) {
                         $query->whereStatus('1');
                     })
                     ->post()->active()->orderBy('id', 'desc')->paginate(10);

        if ($posts->count() > 0) {
            return PostsResource::collection($posts);
        } else {
            return response()->json(
                ['message' => 'No posts found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function get_announcements()
    {
        $announcements = Announcement::with(['user'])
                                     ->whereHas('user', function ($query) {
                                         $query->whereStatus(1);
                                     })->whereStatus(1)->orderBy('id', 'desc')
                                     ->get();

        if ($announcements->count() > 0) {
            return response()->json(
                [
                    'announcements' => AnnouncementsResource::collection(
                        $announcements
                    ),
                    'error'         => false,
                ],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No announcements found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function get_recent_posts()
    {
        $posts = Post::with(['category', 'media', 'user'])
                     ->whereHas('category', function ($query) {
                         $query->whereStatus(1);
                     })
                     ->whereHas('user', function ($query) {
                         $query->whereStatus(1);
                     })
                     ->wherePostType('post')->whereStatus(1)->orderBy(
                'id',
                'desc'
            )->limit(5)->get();

        if ($posts->count() > 0) {
            return response()->json(
                [
                    'posts' => PostsResource::collection($posts),
                    'error' => false,
                ],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No posts found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function get_recent_announcements()
    {
        $announcements = Announcement::with(['user'])
                                     ->whereHas('user', function ($query) {
                                         $query->whereStatus(1);
                                     })->whereStatus(1)->orderBy('id', 'desc')
                                     ->limit(5)->get();

        if ($announcements->count() > 0) {
            return response()->json(
                [
                    'announcements' => AnnouncementsResource::collection(
                        $announcements
                    ),
                    'error'         => false,
                ],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No announcements found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }


    public function get_authors()
    {
        $authors = User::whereStatus(1)->whereHas('posts', function ($query) {
            $query->wherePostType('post');
        })->withCount('posts')->orderBy('id', 'desc')->get();

        if ($authors->count() > 0) {
            return response()->json(
                [
                    'authors' => UserResource::collection($authors),
                    'error'   => false,
                ],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No authors found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function get_archives()
    {
        $archives = Post::selectRaw(
            'year(created_at) year, monthname(created_at) month, count(*) published'
        )
                        ->wherePostType('post')
                        ->whereStatus(1)
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(created_at) desc')
                        ->get();

        if ($archives->count() > 0) {
            return response()->json(['archives' => $archives, 'error' => false],
                200);
        } else {
            return response()->json(
                ['message' => 'No archives found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function get_tags()
    {
        $tags = Tag::withCount('posts')->get();
        if ($tags->count() > 0) {
            return response()->json(
                ['tags' => TagsResource::collection($tags), 'error' => false],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No tags found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function show_post($slug)
    {
        $post = Post::with([
            'category',
            'media',
            'user',
            'tags',
            'volume',
            'issue' => function ($query) {
                $query->orderBy('id', 'desc');
            },
        ]);

        $post = $post->whereHas('category', function ($query) {
            $query->whereStatus('1');
        })
                     ->whereHas('user', function ($query) {
                         $query->whereStatus('1');
                     });

        $post = Post::where('slug_en', $slug);
        $post = $post->active()->post()->first();

        if ($post) {
            return response()->json(
                ['post' => new PostResource($post), 'error' => false],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No post found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    // app/Http/Controllers/Api/General/GeneralController.php
    public function downloadAllPdfs($slug)
    {
        $post = Post::where('slug_en', $slug)->firstOrFail();
        $pdfFiles = $post->media()->where('file_type', 'application/pdf')->get();

        if ($pdfFiles->isEmpty()) {
            return response()->json(['error' => 'No PDFs found for this post.'], 404);
        }

        $zip = new ZipArchive();
        $zipFileName = $post->title(). '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($pdfFiles as $file) {
                $filePath = public_path('assets/posts/' . $file->file_name);
                $zip->addFile($filePath, $file->real_file_name);
            }
            $zip->close();
        }

        return response()->download($zipFilePath, $zipFileName, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
        ])->deleteFileAfterSend(true);
    }


    public function page_show($slug)
    {
        $page = Post::where('slug_en', $slug);
        $page = $page->active()->Where('post_type', 'page')->first();

        if ($page) {
            return response()->json(
                ['page' => new PageResource($page), 'error' => false],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No page found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function show_announcement($slug)
    {
        $announcement = Announcement::with(['user']);

        $announcement = $announcement->whereHas('user', function ($query) {
            $query->whereStatus('1');
        });

        $announcement = Announcement::whereSlug($slug);
        $announcement = $announcement->active()->first();;

        if ($announcement) {
            return response()->json(
                [
                    'announcement' => new UsersAnnouncementResource(
                        $announcement
                    ),
                    'error'        => false,
                ],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No announcement found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function search(Request $request)
    {
        $keyword = isset($request->keyword) && $request->keyword != ''
            ? $request->keyword : null;

        $posts = Post::with(['media', 'user', 'tags'])
                     ->whereHas('category', function ($query) {
                         $query->whereStatus('1');
                     })
                     ->whereHas('user', function ($query) {
                         $query->whereStatus('1');
                     });

        if ($keyword != null) {
            $posts = $posts->search($keyword, null, true);
        }

        $posts = $posts->post()->active()->orderBy('id', 'desc')->paginate(10);

        if ($posts) {
            return PostsResource::collection($posts);
        } else {
            return response()->json(
                ['message' => 'No post found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->whereStatus(1)->first();
        if ($category) {
            $posts = Post::with(['media', 'user', 'tags'])
                         ->whereCategoryId($category->id)
                         ->post()
                         ->active()
                         ->orderBy('id', 'desc')
                         ->get();

            if ($posts->count() > 0) {
                return response()->json(
                    [
                        'posts' => PostsResource::collection($posts),
                        'error' => false,
                    ],
                    200
                );
            } else {
                return response()->json(
                    ['message' => 'No post found', 'error' => true],
                    201
                );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
            }
        }

        return response()->json(
            ['message' => 'Something was Wrong', 'error' => true],
            201
        );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->first()->id;
        if ($tag) {
            $posts = Post::with(['media', 'user', 'tags'])
                         ->whereHas('tags', function ($query) use ($slug) {
                             $query->where('slug', $slug);
                         })
                         ->post()
                         ->active()
                         ->orderBy('id', 'desc')
                         ->get();
            if ($posts->count() > 0) {
                return response()->json(
                    [
                        'posts' => PostsResource::collection($posts),
                        'error' => false,
                    ],
                    200
                );
            } else {
                return response()->json(
                    ['message' => 'No post found', 'error' => true],
                    201
                );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
            }
        }

        return response()->json(
            ['message' => 'Something was Wrong', 'error' => true],
            201
        );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
    }

    public function archive($date)
    {
        $exploded_date = explode('-', $date);
        $month         = $exploded_date[0];
        $year          = $exploded_date[1];

        $posts = Post::with(['media', 'user', 'tags'])
                     ->whereMonth('created_at', $month)
                     ->whereYear('created_at', $year)
                     ->post()
                     ->active()
                     ->orderBy('id', 'desc')
                     ->paginate(5);

        if ($posts->count() > 0) {
            return  PostsResource::collection($posts);
        } else {
            return response()->json(
                ['message' => 'No post found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function author($username)
    {
        $author = User::whereUsername($username)->whereStatus(1)->first();
        if ($author) {
            $posts = Post::with(['media', 'user', 'tags'])
                         ->whereUserId($author->id)
                         ->post()
                         ->active()
                         ->orderBy('id', 'desc')
                         ->get();
            if ($posts->count() > 0) {
                return response()->json(
                    [
                        'posts' => PostsResource::collection($posts),
                        'error' => false,
                    ],
                    200
                );
            } else {
                return response()->json(
                    ['message' => 'No post found', 'error' => true],
                    201
                );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
            }
        }

        return response()->json(
            ['message' => 'Something was Wrong', 'error' => true],
            201
        );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
    }

    public function do_contact(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required|email',
            'mobile'  => 'nullable|numeric',
            'title'   => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        if ($validation->fails()) {
            return response()->json(
                ['message' => $validation->errors(), 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }

        $data['name']    = $request->name;
        $data['email']   = $request->email;
        $data['mobile']  = $request->mobile;
        $data['title']   = $request->title;
        $data['message'] = $request->message;

        Contact::create($data);

        return response()->json(
            [
                'message' => 'Your message has been sent successfully',
                'error'   => false,
            ],
            200
        );
    }

}
