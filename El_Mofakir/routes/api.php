<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Api\ApiController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Users\UsersController;

/*********** API *****************************/

Route::controller(GeneralController::class)->group(function () {
    Route::get('/all_announcements', 'get_announcements');
    Route::get('/announcement/{slug}', 'show_announcement');

    Route::get('/all_posts',  'get_posts');
    Route::get('/post/{slug}',  'show_post');
    Route::get(
        '/posts/{post}/download-all',
         'downloadAllPdfs'
    );
    Route::get('/page/{page}',  'page_show');

    Route::get('/all_posts', 'get_posts');
    Route::get('/post/{slug}', 'show_post')->name('post.show');
    Route::get('/posts/{post}/download-all', 'downloadAllPdfs')->name(
        'posts.download_all'
    );
    Route::get('/page/{page}', 'page_show');

    Route::get('/category/{category_slug}', 'category')->name('category.show');
    Route::get('/tag/{tag_slug}', 'tag')->name('tag.show');
    Route::post('/contact-us', 'do_contact');

    // sidebar
    Route::get('/search', 'search');
    Route::get('/recent_posts', 'get_recent_posts');
    Route::get('/recent_announcements', 'get_recent_announcements');

    Route::get('/volumes', 'get_volumes');
    Route::get('/authors', 'get_authors');
    Route::get('/tags', 'get_tags');

    Route::get('/volume/{number}', 'issues');
    Route::get('/author/{username}', 'author');

});





