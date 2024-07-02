<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $params = $request->validate([
            'email' => ['required', 'email'],
            'password'=> ['required', 'min:5']
        ]);

        $user = User::where('email', $params['email'])->first();
        if(Hash::check($request->password, $user->password)){
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                "message"=> "Login success",
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'accessToken' => $token
                ]
            ],200);
        }

        return response()->json([
            "message"=> "Email or password incorrect"
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
