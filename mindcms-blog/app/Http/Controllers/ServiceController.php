<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public  function change_language($locale): \Illuminate\Http\RedirectResponse
    {
        try {
            if(array_key_exists($locale, config('locale.languages'))){
                App::setLocale($locale);
                Lang::setLocale($locale);
                Session::put('locale', $locale);
                Carbon::setLocale($locale);
            }
            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }
}
