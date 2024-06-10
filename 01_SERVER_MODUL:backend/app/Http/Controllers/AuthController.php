<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:4|max:60'
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ],201);

        $token = $user->createToken('token',['role:user'])->plainTextToken;

        return response()->json([
            'status' => true,
            'token'  => $token
        ],201);

    }

    public function signin(Request $request)
    {
        $request->validate([
        'username' => 'required|min:4|max:60',
        'password' => 'required|min:4|max:60'
    ]);



        $user = User::where('username', $request->username)->first();
        if($user && Hash::check( $request->password, $user->password)){
            $token = $user->createToken('token', ['role:user'])->plainTextToken;
            return response()->json([
                'status' => true,
                'token' => $token,
                'role' => 'user'
            ],200);
        }

        $admin = Administrator::where('username', $request->username)->first();
        if($admin && Hash::check( $request->password, $admin->password)){
            $token = $admin->createToken('token', ['role:admin'])->plainTextToken;
            return response()->json([
                'status' => true,
                'token' => $token,
                'role' => 'admin'
            ],200);
        }


        return response()->json([
            'status' => 'invalid',
            'message' => 'Wrong username or password'
        ],401);

    }

    public function signout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success'
        ],200);
    }
}
