<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'full_name' => 'required|',
        'bio' => 'required|max:100',
        'username' => 'required|min:3|unique:users,username|',
        'password' => 'required|min:6',
        'is_private' => 'nullable|boolean'
    ]);

    if ($validator->fails()) {
        return response()->json([
            "message" => "Invalid field",
            'errors' => $validator->errors()
        ], 422);
    }


    $user = User::create([
        'full_name' => $request->full_name,
        'username' => ( $request->username),
         'password' => Hash::make( $request->password),
        'bio' => $request->bio,
        'is_private' => $request->is_private,
    ]);

    $token= $user->createToken('token')->plainTextToken;

    return response()->json([
        "message"=> "Register success",
        'token' => $token,
        'user' => $user
    ],201);

}

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [

        'username' => 'required|min:3',
        'password' => 'required|min:6',

    ]);

    if ($validator->fails()) {
        return response()->json([
            "message" => "Invalid field",
            'errors' => $validator->errors()
        ], 422);
    }


    $user = User::where('username', $request->username)->first();
    if(Hash::check($request->password, $user->password)){
        $token= $user->createToken('token')->plainTextToken;
        return response()->json([
            "message"=> "Login success",
            'token' => $token,
            'user'=> $user
        ],200);
    }

    return response()->json([
        "message"=> "Wrong username or password"
    ],401);

}

public function logout()
{
    auth()->user()->currentAccessToken()->delete();

    return response()->json([
        "message"=> "Logout success"
    ],200);

}
}
