<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;

use App\Http\Resources\General\{AnnouncementsResource,
    PageResource,
    PostResource,
    TagsResource,
    UserResource,
    PostsResource
};
use App\Models\{Announcement,
    Category,
    Contact,
    Issue,
    Post,
    Setting,
    Tag,
    User,
    Volume
};
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ZipArchive;

class GeneralController extends Controller
{

    public function get_posts()
    {
        $posts = Post::whereRelation('category', 'status', 1)
                     ->whereRelation('user', 'status', 1)
                     ->post()->active()->orderBy('id', 'desc')
                     ->paginate(10);

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
                                     ->whereRelation('user', 'status', 1)
                                     ->active()->orderBy('id', 'desc')
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
        $posts = Post::with(['category', 'media', 'authors'])
                     ->whereRelation('category', 'status', 1)
                     ->post()->active()->orderBy(
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
                                     ->whereRelation('user', 'status', 1)
                                     ->active()->orderBy('id', 'desc')
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

    public function get_volumes()
    {
        $volumes = Volume::where('status', 1)->get();

        if ($volumes->count() > 0) {
            return response()->json([
                'volumes' => $volumes->map(function ($volume) {
                    return [
                        'number' => $volume->number,
                        'year'   => $volume->year,
                        'status' => $volume->status(),
                    ];
                }),
                'error'   => false,
            ], 200);
        } else {
            return response()->json(
                ['message' => 'No volumes found', 'error' => true],
                201
            );
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

        $post = $post->whereRelation('category', 'status', 1)
                     ->whereRelation('user', 'status', 1);
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

        $announcement = $announcement->whereRelation('user', 'status', 1);
        $announcement = Announcement::whereSlug($slug);
        $announcement = $announcement->active()->first();;

        if ($announcement) {
            return response()->json(
                [
                    'announcement' => new AnnouncementsResource(
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
                     ->whereRelation('category', 'status', 1)
                     ->whereRelation('user', 'status', 1);

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
        $category = Category::whereSlug($slug)->active()->first();
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
                         ->whereRelation('tags', 'slug', $slug)
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

    public function issues($volumeNumber)
    {
        $volume = Volume::whereNumber($volumeNumber)->first();

        if ( ! $volume) {
            return response()->json(
                ['message' => 'Volume not found', 'error' => true],
                201
            );
        }

        $issues = $volume->issues()->with('posts')->get();

        if ($issues->count() > 0) {
            return response()->json([
                'issues' => $issues->map(function ($issue) {
                    return [
                        'issue_number' => $issue->issue_number,
                        'issue_date'   => $issue->issue_date,
                        'posts'        => $issue->posts->map(function ($post) {
                            return [
                                'post' => new PostResource($post),
                            ];
                        }),
                    ];
                }),
                'error'  => false,
            ], 200);
        } else {
            return response()->json(
                [
                    'message' => 'No issues found for this volume',
                    'error'   => true,
                ],
                201
            );
        }
    }

    public function downloadAllPdfs($slug)
    {
        $post     = Post::where('slug_en', $slug)->firstOrFail();
        $pdfFiles = $post->media()->where('file_type', 'application/pdf')->get(
        );

        if ($pdfFiles->isEmpty()) {
            return response()->json(['error' => 'No PDFs found for this post.'],
                404);
        }

        $zip         = new ZipArchive();
        $zipFileName = $post->title() . '.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach ($pdfFiles as $file) {
                $filePath = public_path('assets/posts/' . $file->file_name);
                $zip->addFile($filePath, $file->real_file_name);
            }
            $zip->close();
        }

        return response()->download($zipFilePath, $zipFileName, [
            'Content-Type'        => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName
                                     . '"',
        ])->deleteFileAfterSend(true);
    }

    public function downloadIssuePdfs($issueDate)
    {
        $issue    = Issue::where('issue_date', $issueDate)->firstOrFail();
        $posts    = $issue->posts;
        $pdfFiles = [];
        foreach ($posts as $post) {
            $postMedia = $post->media()->where('file_type', 'application/pdf')
                              ->get();
            foreach ($postMedia as $media) {
                $pdfFiles[] = $media;
            }
        }

        if (empty($pdfFiles)) {
            return response()->json(
                ['error' => 'No PDFs found for this issue.'],
                404
            );
        }

        $zip         = new ZipArchive();
        $zipFileName = 'issue_' . $issueDate . '_pdfs.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach ($pdfFiles as $file) {
                $filePath = public_path('assets/posts/' . $file->file_name);
                $zip->addFile($filePath, $file->real_file_name);
            }
            $zip->close();
        }

        return response()->download($zipFilePath, $zipFileName, [
            'Content-Type'        => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName
                                     . '"',
        ])->deleteFileAfterSend(true);
    }

    public function get_authors()
    {
        $authors = User::active()
                       ->whereRelation('posts', 'post_type', 'post')
                       ->withCount('posts')->orderBy('id', 'desc')->get();

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

    public function author($name)
    {
        $user = User::whereName($name)->whereRelation('roles', 'name', 'user')
                    ->first();

        $media = $user->media->whereUserId($user->id)->where(
            'file_type',
            'application/pdf'
        )->first();
        if ($media) {
            $filePath = public_path('assets/users/' . $media->file_name);

            return response()->download($filePath, $media->real_file_name);
        }

        return response()->json(
            ['errors' => true, 'message' => __('messages.no_pdf_files')],
            201
        );
    }

    public function get_professionals()
    {
        $authors = User::active()
                       ->whereRelation('roles', 'name', 'professional')
                       ->whereRelation('posts', 'post_type', 'post')
                       ->withCount('posts')->orderBy('id', 'desc')->get();

        if ($authors->count() > 0) {
            return response()->json(
                [
                    'professionals' => UserResource::collection($authors),
                    'error'         => false,
                ],
                200
            );
        } else {
            return response()->json(
                ['message' => 'No professionals found', 'error' => true],
                201
            );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
        }
    }

    public function professional($name)
    {
        $user = User::whereName($name)->whereRelation(
            'roles',
            'name',
            'professional'
        )->first();

        $media = $user->media->where('user_id', $user->id)->where(
            'file_type',
            'application/pdf'
        )->first();
        if ($media) {
            $filePath = public_path('assets/users/' . $media->file_name);

            return response()->download($filePath, $media->real_file_name);
        }

        return response()->json(
            ['errors' => true, 'message' => __('messages.no_pdf_files')],
            201
        );
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
                'message' => __('messages.contact_message_sent'),
                'error'   => false,
            ],
            200
        );
    }

    public function settings()
    {
        $settings = Setting::whereIn('key', [
            'facebook_id',
            'google_map_api_key',
            'address',
            'phone_number',
            'website_univ',
        ])->select('value', 'key', 'lang')->get();

        return response()->json([
            'settings' => $settings,
            'error'    => false,
        ], 200);
    }

}
