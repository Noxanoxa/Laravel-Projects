<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //        'user_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:20000']
        ]);

        if($validation->fails()) {
            return response()->json(['errors' => true, 'message' => $validation->errors()], 201); // 201 instead 401 for mobile app developers
        }
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['email_verified_at'] = Carbon::now();
        $data['mobile'] = $request->mobile;
        $data['password'] = bcrypt($request->password);
        $data['status'] = 1;
        //        $data['user_image'] = $request->user_image;

        $user = User::create($data);
        $user->attachRole(Role::whereName('user')->first()->id);

        return $this->getRefreshToken($request->email, $request->password);

    }

    public function login(Request $request)
    {
        if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password]) )
        {
            $email = Auth::user()->email;
            return $this->getRefreshToken($email, $request->password);
        } else {
            return response()->json(['errors' => true, 'message' => 'Unauthorized']);
        }


    }

    public function getRefreshToken($email, $password)
    {

        $verifyValue = app()->environment() == 'local' ? false : true;
        $response = Http::withOptions([
            'verify' => $verifyValue,

        ])->post(config('app.url') . '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => config('passport.personal_access_client.id'),
                'client_secret' => config('passport.personal_access_client.secret'),
                'username' => $email,
                'password' => $password,
                'scope' => '*',
        ]);


        return response()->json($response->json(), 200);



    }

    public function refresh_token(Request $request)
    {

        $refresh_token = $request->header('RefreshTokenCode');
        $verifyValue = app()->environment() == 'local' ? false : true;
        try {
            $response = Http::withOptions([
                'verify' => $verifyValue,

            ])->post(config('app.url') . '/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => config('passport.personal_access_client.id'),
                'client_secret' => config('passport.personal_access_client.secret'),
                'scope' => '*',
            ]);

            return response()->json($response->json(), 200);
        } catch (\Exception $e) {
            return response()->json( 'Unauthorized', 201);// 201 instead 401 for mobile app developers
        }

    }
}
