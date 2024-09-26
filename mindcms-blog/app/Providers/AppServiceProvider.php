<?php

namespace App\Providers;


use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//    Paginator::useBootstrapThree() ;
        Paginator::defaultView('vendor.pagination.bootstrap-4');
    $locale = config('app.locale') == 'ar' ? 'ar' : config('app.locale');
    App::setLocale($locale);
    Lang::setLocale($locale);
    Session::put('locale', $locale);
    Carbon::setLocale($locale);




    }
}
