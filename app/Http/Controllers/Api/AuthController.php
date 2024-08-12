<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Hash};
use App\Models\User;

use App\Http\Requests\{LoginRequest, CreateUserRequest};
class AuthController extends Controller
{
    //

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            // successfull authentication
            $user = User::find(Auth::user()->id);

            $user_token['token'] = $user->createToken('appToken')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $user_token,
                'user' => $user,
            ], 200);
        } else {
            // failure to authenticate
            return response()->json([
                'success' => false,
                'message' => 'Invalid User.',
            ], 401);
        }
    }

    public function create(CreateUserRequest $request) 
    {

        User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                    ]);
        return response()->json([
                'success' => true,
                'message' =>'User Created.'
            ], 200);

    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logged out success',
            ], 200);
        }
    }
}
