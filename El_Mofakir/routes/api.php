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

    Route::get('/all_posts', [GeneralController::class, 'get_posts']);
    Route::get('/post/{slug}', [GeneralController::class, 'show_post']);
    Route::get(
        '/posts/{post}/download-all',
        [GeneralController::class, 'downloadAllPdfs']
    );
    Route::get('/page/{page}', [GeneralController::class, 'page_show']);

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

    Route::get('/archives', 'get_archives');
    Route::get('/authors', 'get_authors');
    Route::get('/tags', 'get_tags');

    Route::get('/archive/{date}', 'archive');
    Route::get('/author/{username}', 'author');

});

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('refresh_token', 'refresh_token');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::controller(UsersController::class)->group(function () {
        Route::any('/notifications/get', 'getNotifications');
        Route::any('/notifications/read', 'markAsRead');

        Route::get('/user_information', 'user_information');
        Route::patch('/edit_user_information', 'update_user_information');
        Route::patch('/edit_user_password', 'update_user_password');

        // announcements
        Route::get('/my_announcements', 'my_announcements');
        Route::get('/my_announcements/create', 'create_announcement');
        Route::post('/my_announcements/create', 'store_announcement');
        Route::get(
            '/my_announcements/{announcement}/edit',
            'edit_announcement'
        );
        Route::patch(
            '/my_announcements/{announcement}/edit',
            'update_announcement'
        );
        Route::delete(
            '/my_announcements/{announcement}',
            'delete_announcement'
        );

        Route::post('logout', 'logout');
    });
});





