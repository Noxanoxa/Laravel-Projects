<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ( ! request()->is('admin/*')) {
            Paginator::defaultView('vendor.pagination.boighor');

            view()->composer('*', function ($view) {
                if ( ! Cache::has('recent_posts')) {
                    $recent_posts = Post::with(['category', 'media', 'user'])
                                        ->whereRelation('category', 'status', 1)
                                        ->whereRelation('user', 'status', 1)
                                        ->post()->active()->orderBy(
                            'id',
                            'desc'
                        )->limit(5)->get();

                    Cache::remember(
                        'recent_posts',
                        3600,
                        function () use ($recent_posts) {
                            return $recent_posts;
                        }
                    );
                }

                $recent_posts = Cache::get('recent_posts');

                if ( ! Cache::has('global_categories')) {
                    $global_categories = Category::active()->orderBy(
                        'id',
                        'desc'
                    )->get();
                    Cache::remember(
                        'global_categories',
                        3600,
                        function () use ($global_categories) {
                            return $global_categories;
                        }
                    );
                }

                $global_categories = Cache::get('global_categories');

                if ( ! Cache::has('global_tags')) {
                    $global_tags = Tag::withCount('posts')->get();
                    Cache::remember(
                        'global_tags',
                        3600,
                        function () use ($global_tags) {
                            return $global_tags;
                        }
                    );
                }

                $global_tags = Cache::get('global_tags');

                if ( ! Cache::has('global_archives')) {
                    $global_archives = Post::active()->orderBy(
                        'created_at',
                        'desc'
                    )
                                           ->select(
                                               DB::raw(
                                                   "Year(created_at) as year"
                                               ),
                                               DB::raw(
                                                   "Month(created_at) as month"
                                               )
                                           )
                                           ->pluck('year', 'month')->toArray();
                    Cache::remember(
                        'global_archives',
                        3600,
                        function () use ($global_archives) {
                            return $global_archives;
                        }
                    );
                }

                $global_archives = Cache::get('global_archives');

                if ( ! Cache::has('recent_announcements')) {
                    $recent_announcements = Post::with(['user'])
                                                ->whereRelation(
                                                    'user',
                                                    'status',
                                                    1
                                                )
                                                ->active()->orderBy(
                            'id',
                            'desc'
                        )->limit(5)->get();

                    Cache::remember(
                        'recent_announcements',
                        3600,
                        function () use ($recent_announcements) {
                            return $recent_announcements;
                        }
                    );
                }

                $recent_announcements = Cache::get('recent_announcements');

                $view->with([
                    'recent_posts' => $recent_posts,
                    'recent_announcements' => $recent_announcements,
                    'global_categories' => $global_categories,
                    'global_tags' => $global_tags,
                    'global_archives' => $global_archives,
                ]);
            });
        }

        if (request()->is('admin/*')) {
            view()->composer('*', function ($view) {
                if ( ! Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Permission::tree());
                }

                $admin_side_menu = Cache::get('admin_side_menu');

                $view->with([
                    'admin_side_menu' => $admin_side_menu,

                ]);
            });
        }
    }

}
