<?php

namespace App\Http\Controllers\API;


use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AuthController extends Controller
{

    // use HasApiTokens;
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:8',
        ]);
        if($validator->fails())
        return response()->json([
            'validation_errors' => $validator->getMessageBag(),
        ]);
        else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken($user->email.'_Token ')->plainTextToken;
            return response()->json([
                'status' => 200,
                'username' => $user->name,
                'token' => $token,
                'message' => 'Registered Successfully',
            ]);
        }

    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191',
            'password' => 'required',
        ]);

        if($validator->fails())
        return response()->json([
            'validation_errors'=> $validator->getMessageBag(),
        ]);
        else {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status'=> 401,
                    'message'=> 'Invalid Credentials',
                ]);
            }
            else {
                if($user->role_as == 1) // 1 => Admin
                {
                    $role = 'admin';
                    $token = $user->createToken($user->email . '_AdminToken', ['server:admin'])->plainTextToken;
                }
                else
                {
                    $role = 'user';
                    $token = $user->createToken($user->email.'_Token ', [''])->plainTextToken;
                }
                return response()->json([
                    'status' => 200,
                    // 'userid' => $user->id,
                    'username' => $user->name,
                    'token' => $token,
                    'message' => 'Logged In Successfully',
                    'role' => $role,
                ]);
                }

        }
    }

    public function logout () {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged Out Seccussfully',
        ]);
    }

}
