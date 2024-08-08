<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
/*        if($user->status == 0) {
            auth()->logout();
            return redirect()->route('frontend.index')->with([
                'message' => 'Your account is not activated yet. Please check your email for activation link.',
                'alert-type' => 'error',
            ]);
        }
        if($user->status == 2) {
            auth()->logout();
            return redirect()->route('frontend.index')->with([
                'message' => 'Your account has been blocked.',
                'alert-type' => 'error',
            ]);
        }*/
        if($user->status ==1) {
            return redirect()->route('users.dashboard')->with([
                'message'    => 'Logged In Successfully ' . $user->name,
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('frontend.index')->with([
            'message'    => 'Your account is not activated yet. Please check your email for activation link or contact Bloggi Admin.',
            'alert-type' => 'warning',
        ]);
    }

}
