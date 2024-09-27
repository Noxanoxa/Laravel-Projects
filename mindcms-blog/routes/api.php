<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Api\ApiController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Users\UsersController;

Route::get('/chart/comments_chart', [ApiController::class,   'comments_chart']);
Route::get('/chart/users_chart', [ApiController::class, 'users_chart']);

/*********** API *****************************/
Route::get('/all_announcements', [GeneralController::class, 'get_announcements']);
Route::get('/announcement/{slug}', [GeneralController::class, 'show_announcement']);

Route::get('/all_posts', [GeneralController::class, 'get_posts']);
Route::get('/post/{slug}', [GeneralController::class, 'show_post']);
Route::get('/{page}', [GeneralController::class, 'page_show']);
Route::post('/post/{slug}',                                  [GeneralController::class, 'store_comment']);


Route::get('/category/{category_slug}',                 [GeneralController::class, 'category']);
Route::get('/tag/{tag_slug}',                           [GeneralController::class, 'tag']);
Route::post('/contact-us',                              [GeneralController::class, 'do_contact']);

// sidebar
Route::get('/search',                                   [GeneralController::class, 'search']);
Route::get('/recent_posts',                             [GeneralController::class, 'get_recent_posts']);
Route::get('/recent_announcements',                             [GeneralController::class, 'get_recent_announcements']);
Route::get('/recent-comments',                          [GeneralController::class, 'get_recent_comments']);
Route::get('/archives',                                 [GeneralController::class, 'get_archives']);
Route::get('/authors',                                  [GeneralController::class, 'get_authors']);
Route::get('/tags',                                    [GeneralController::class, 'get_tags']);



Route::get('/archive/{date}',                           [GeneralController::class, 'archive']);
Route::get('/author/{username}',                        [GeneralController::class, 'author']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh_token', [AuthController::class, 'refresh_token']);

Route::group(['middleware' => ['auth:api']], function() {

    Route::any('/notifications/get',               [UsersController::class, 'getNotifications']);
    Route::any('/notifications/read',              [UsersController::class, 'markAsRead']);


    Route::get('/user_information', [UsersController::class, 'user_information']);
        Route::patch('/edit_user_information', [UsersController::class, 'update_user_information']);
        Route::patch('/edit_user_password', [UsersController::class, 'update_user_password']);

    Route::get('/my_posts', [UsersController::class, 'my_posts']);
    Route::get('/my_posts/create', [UsersController::class, 'create_post']);
    Route::post('/my_posts/create', [UsersController::class, 'store_post']);
    Route::get('/my_posts/{post}/edit', [UsersController::class, 'edit_post']);
    Route::patch('/my_posts/{post}/edit', [UsersController::class, 'update_post']);
    Route::delete('/my_posts/{post}', [UsersController::class, 'delete_post']);
    Route::post('/delete_post_media/{media_id}', [UsersController::class, 'destroy_post_media']);

    // announcements
    Route::get('/my_announcements', [UsersController::class, 'my_announcements']);
    Route::get('/my_announcements/create', [UsersController::class, 'create_announcement']);
    Route::post('/my_announcements/create', [UsersController::class, 'store_announcement']);
    Route::get('/my_announcements/{announcement}/edit', [UsersController::class, 'edit_announcement']);
    Route::patch('/my_announcements/{announcement}/edit', [UsersController::class, 'update_announcement']);
    Route::delete('/my_announcements/{announcement}', [UsersController::class, 'delete_announcement']);

    Route::get('all_comments', [UsersController::class, 'all_comments']);
    Route::get('/comments/{id}/edit', [UsersController::class, 'edit_comment']);
    Route::patch('/comments/{id}/edit', [UsersController::class, 'update_comment']);
    Route::delete('/comments/{id}', [UsersController::class, 'delete_comment']);

    Route::post('logout', [UsersController::class, 'logout']);
});

