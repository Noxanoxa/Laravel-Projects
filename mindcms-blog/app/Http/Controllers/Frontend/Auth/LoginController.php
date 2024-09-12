<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

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

            // in case api
            if($request->wantsJson()) {
                $token = $user->createToken('access_token')->accessToken;
                return response()->json([
                    'errors' => false,
                    'message' => 'Logged In Successfully',
                    'token' => $token,
                ]);
            }

            return redirect()->route('users.dashboard')->with([
                'message'    => 'Logged In Successfully ' . $user->name,
                'alert-type' => 'success',
            ]);
        }

        // in case api
        if($request->wantsJson()) {
            return response()->json([
                'errors' => false,
                'message' => 'Your account is not activated yet. Please check your email for activation link or contact Bloggi Admin.',
            ]);
        }


        return redirect()->route('frontend.index')->with([
            'message'    => 'Your account is not activated yet. Please check your email for activation link or contact Bloggi Admin.',
            'alert-type' => 'warning',
        ]);
    }

    /*
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
    */

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /*
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
    */

    public function handleProviderCallback($provider)
    {
        $social_user = Socialite::driver($provider)->user();

//        dd($provider, $social_user);

        $token = $social_user->token;
        $id = $social_user->getId();
        $nickName = $social_user->getNickname();
        $name = $social_user->getName();
        $email = $social_user->getEmail() == '' ? trim(Str::lower(Str::replaceArray(' ', ['_'], $name))) . '@' .  $provider . '.com':  $social_user->getEmail();
        $avatar = $social_user->getAvatar();

        // not need it so comment it
//        $refreshToken = $social_user->refreshToken;
//        $expiresIn = $social_user->expiresIn;
//        $token = $social_user->token;
//        $tokenSecret = $social_user->tokenSecret;

        // All providers...


        $user = User::firstOrCreate([
                'email' => $email,
            ], [
            'name' => $name,
            'username' => $nickName != '' ? $nickName :   trim(Str::lower(Str::replaceArray(' ', ['_'], $name))),
            'email' => $email,
            'email_verified_at' => Carbon::now(),
            'mobile' => $id,
            'status' => 1,
            'receive_email' => 1,
            'remember_token' => $token,
            'password' => Hash::make($email),
        ]);

        if ($user->user_image == '') {
            $filename = '' . $user->username .'.jpg';
            $path = public_path('/assets/users/' . $filename);
            Image::make($avatar)->save($path, 100);
            $user->update(['user_image' => $filename]);
        }
        $user->attachRole(Role::whereName('user')->first()->id);

        Auth::login($user, true);

        return redirect()->route('users.dashboard')->with([
            'message' => 'Logged in successfully',
            'alert-type' => 'success'
        ]);

    }


}
