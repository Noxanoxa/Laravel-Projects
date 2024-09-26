<?php

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use App\Http\Controllers\ServiceController;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    Route::get('/',                                         [Frontend\IndexController::class, 'index'])->name('frontend.index');
    // Authentication Routes...
    Route::get('/login',                                    [Frontend\Auth\LoginController::class, 'showLoginForm'])->name('frontend.show_login_form');
    Route::post('login',                                    [Frontend\Auth\LoginController::class, 'login'])->name('frontend.login');

    Route::get('login/{provider}',                                  [Frontend\Auth\LoginController::class, 'redirectToProvider'])->name('frontend.social_login');
    Route::get('login/{provider}/callback',                 [Frontend\Auth\LoginController::class, 'handleProviderCallback'])->name('frontend.social_login_callback');

    Route::post('logout',                                   [Frontend\Auth\LoginController::class, 'logout'])->name('frontend.logout');
    Route::get('register',                                  [Frontend\Auth\RegisterController::class, 'showRegistrationForm'])->name('frontend.show_register_form');
    Route::post('register',                                 [Frontend\Auth\RegisterController::class, 'register'])->name('frontend.register');
    Route::get('password/reset',                            [Frontend\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email',                           [Frontend\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}',                    [Frontend\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset',                           [Frontend\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('email/verify',                              [Frontend\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',                 [Frontend\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend',                             [Frontend\Auth\VerificationController::class, 'resend'])->name('verification.resend');

    Route::get('/change_locale/{locale}',                  [ServiceController::class, 'change_language'])->name('change_locale');
    Route::group(['middleware' => 'verified', 'as' => 'users.'], function () {
        Route::get('/dashboard',                            [Frontend\UsersController::class, 'index'])->name('dashboard');
        Route::any('/user/notifications/get',               [Frontend\NotificationsController::class, 'getNotifications']);
        Route::any('/user/notifications/read',              [Frontend\NotificationsController::class, 'markAsRead']);
        Route::get('/edit-info',                            [Frontend\UsersController::class, 'edit_info'])->name('edit_info');
        Route::post('/edit-info',                           [Frontend\UsersController::class, 'update_info'])->name('update_info');
        Route::post('/edit-password',                       [Frontend\UsersController::class, 'update_password'])->name('update_password');
        Route::get('/create-post',                          [Frontend\UsersController::class, 'create_post'])->name('post.create');
        Route::post('/create-post',                         [Frontend\UsersController::class, 'store_post'])->name('post.store');
        Route::get('/edit-post/{post_id}',                  [Frontend\UsersController::class, 'edit_post'])->name('post.edit');
        Route::put('/edit-post/{post_id}',                  [Frontend\UsersController::class, 'update_post'])->name('post.update');
        Route::delete('/delete-post/{post_id}',             [Frontend\UsersController::class, 'destroy_post'])->name('post.destroy');
        Route::post('/delete-post-media/{media_id}',        [Frontend\UsersController::class, 'destroy_post_media'])->name('post.media.destroy');
        Route::get('/comments',                             [Frontend\UsersController::class, 'show_comments'])->name('comments');
        Route::get('/edit-comment/{comment_id}',            [Frontend\UsersController::class, 'edit_comment'])->name('comment.edit');
        Route::put('/edit-comment/{comment_id}',            [Frontend\UsersController::class, 'update_comment'])->name('comment.update');
        Route::delete('/delete-comment/{comment_id}',       [Frontend\UsersController::class, 'destroy_comment'])->name('comment.destroy');
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    // Authentication Routes...
    Route::get('/login',                                [Backend\Auth\LoginController::class, 'showLoginForm'])->name('show_login_form');
    Route::post('login',                                [Backend\Auth\LoginController::class, 'login'])->name('login');
    Route::post('logout',                               [Backend\Auth\LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['roles', 'role:admin|editor']], function() {
        Route::any('/notifications/get',                [Backend\NotificationsController::class, 'getNotifications']);
        Route::any('/notifications/read',               [Backend\NotificationsController::class, 'markAsRead']);

        Route::get('/',                                 [Backend\AdminController::class, 'index'])->name('index_route');
        Route::get('/index',                            [Backend\AdminController::class, 'index'])->name('index');

        Route::post('/posts/removeImage/{media_id}',    [Backend\PostsController::class, 'removeImage'])->name('posts.media.destroy');
        Route::resource('posts',                        Backend\PostsController::class);
        // announcements
        Route::resource('announcements',                Backend\AnnouncementsController::class);

        Route::post('/pages/removeImage/{media_id}',    [Backend\PagesController::class, 'removeImage'])->name('pages.media.destroy');
        Route::resource('pages',                        Backend\PagesController::class);

        Route::resource('post_comments',                Backend\PostCommentsController::class);
        Route::resource('post_categories',              Backend\PostCategoriesController::class);

        Route::resource('post_tags',                    Backend\PostTagsController::class);

        Route::resource('contact_us',                   Backend\ContactUsController::class);

        Route::post('/users/removeImage',               [Backend\UsersController::class, 'removeImage'])->name('users.remove_image');
        Route::resource('users',                        Backend\UsersController::class);
        Route::post('/supervisors/removeImage',         [Backend\SupervisorsController::class, 'removeImage'])->name('supervisors.remove_image');
        Route::resource('supervisors',                  Backend\SupervisorsController::class);
        Route::resource('settings',                     Backend\SettingsController::class);
    });
});

Route::get('/contact-us',                               [Frontend\IndexController::class, 'contact'])->name('frontend.contact');
Route::post('/contact-us',                              [Frontend\IndexController::class, 'do_contact'])->name('frontend.do_contact');
Route::get('/category/{category_slug}',                 [Frontend\IndexController::class, 'category'])->name('frontend.category.posts');

Route::get('/tag/{tag_slug}',                           [Frontend\IndexController::class, 'tag'])->name('frontend.tag.posts');
Route::get('/archive/{date}',                           [Frontend\IndexController::class, 'archive'])->name('frontend.archive.posts');
Route::get('/author/{username}',                        [Frontend\IndexController::class, 'author'])->name('frontend.author.posts');
Route::get('/search',                                   [Frontend\IndexController::class, 'search'])->name('frontend.search');
Route::get('/{post}',                                   [Frontend\IndexController::class, 'post_show'])->name('frontend.posts.show');
Route::post('/{post}',                                  [Frontend\IndexController::class, 'store_comment'])->name('frontend.posts.add_comment');


