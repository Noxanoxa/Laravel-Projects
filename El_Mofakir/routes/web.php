<?php

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use App\Http\Controllers\ServiceController;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
//    Route::get('/',                                         [Frontend\IndexController::class, 'index'])->name('frontend.index');
    Route::get('/change_locale/{locale}',                  [ServiceController::class, 'change_language'])->name('change_locale');
    Route::get('password/reset',                            [Backend\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email',                           [Backend\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}',                    [Backend\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset',                           [Backend\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('email/verify',                              [Backend\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',                 [Backend\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend',                             [Backend\Auth\VerificationController::class, 'resend'])->name('verification.resend');

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

        // volumes
        Route::resource('volumes',                      Backend\VolumesController::class);

        // issues
        Route::resource('issues',                       Backend\IssuesController::class);

        Route::post('/pages/removeImage/{media_id}',    [Backend\PagesController::class, 'removeImage'])->name('pages.media.destroy');
        Route::resource('pages',                        Backend\PagesController::class);


        Route::resource('post_categories',              Backend\PostCategoriesController::class);

        Route::resource('post_tags',                    Backend\PostTagsController::class);

        Route::resource('contact_us',                   Backend\ContactUsController::class);

        Route::post('/users/removeImage',               [Backend\UsersController::class, 'removeImage'])->name('users.remove_image');
        Route::resource('users',                        Backend\UsersController::class);
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

