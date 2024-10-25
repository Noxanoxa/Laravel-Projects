<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function user_information() {
        $user = Auth::user();
        return response()->json(['errors' => false, 'message' =>new UserResource($user)], 200);
    }

    public function getNotifications()
    {
        return [
            'read'      => auth()->user()->readNotifications,
            'unread'    => auth()->user()->unreadNotifications,
        ];
    }

    public function markAsRead(Request $request)
    {
        return auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }

    public function  update_user_information(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'bio' => 'nullable|min:10',
            'receive_email' => 'required',
            'user_image' => 'nullable|image|max:20000|mimes:jpeg,jpg,png',
        ]);
        if($validation->fails())
        {

            return response()->json(['errors' => true, 'message' => $validation->errors()], 201);
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['bio'] = $request->bio;
        $data['receive_email'] = $request->receive_email;
        if($image = $request->file('user_image'))
        {
            if(auth()->user()->user_image != '')
            {
                if(File::exists('assets/users/'.auth()->user()->user_image))
                {
                    unlink('assets/users/'.auth()->user()->user_image);
                }
            }
            $filename = Str::slug(auth()->user()->username) . '.'. $image->getClientOriginalName();
            $path = public_path('assets/users/'. $filename);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);

            $data['user_image'] = $filename;
        }
        $update = auth()->user()->update($data);
        if($update)
        {
            return response()->json(['errors' => false, 'message' =>  __('messages.user_infos_updated_successfully')], 200);
        } else {
            return response()->json(['errors' => true, 'message' => __('messages.something_was_wrong')], 201);
        }
    }

    public function update_user_password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if($validation->fails())
        {
            return response()->json(['errors' => true, 'message' => $validation->errors()], 201);
        }

        $user = auth()->user();
        if(Hash::check($request->current_password, $user->password)){
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);
            if($update)
            {
                return response()->json(['errors' => false, 'message' => __('messages.password_updated_successfully')], 200);
            } else {
                return response()->json(['errors' => true, 'message' => __('messages.something_was_wrong')], 201);
            }
        } else
        {
            return response()->json(['errors' => true, 'message' => __('messages.current_password_wrong')], 201);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['errors' => false, 'message' => __('messages.logout_successfully')], 200);
    }

}
