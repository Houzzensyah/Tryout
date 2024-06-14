<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function signup(Request $request)
  {
      $validator = Validator::make($request->all(), [
           'username' => "required|unique:users,username|min:4|max:60",
             'password' => "required|min:4|max:60",

          ]);


      if($validator->fails()){
          return response()->json([
            'status' => 'invalid',
              'message' => 'Request body is not valid',
              'violations' => collect($validator->errors())->map(function ($errors){
                  return [
                      'message' => collect($errors)->join('')
                  ];
              })
          ],400);

      }

      $user = User::create([
          'username' => $request->username,
          'password' => Hash::make($request->password)
      ]);

$token = $user->createToken('token' , ['role:user'])->plainTextToken;

      return response()->json([
          'status ' => 'success',
          'token' => $token
      ],201);
  }

  public function signin(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'username' => "required|min:4|max:60",
          'password' => "required|min:4|max:60",

      ]);


      if($validator->fails()){
          return response()->json([
              'status' => 'invalid',
              'message' => 'Request body is not valid',
              'violations' => collect($validator->errors())->map(function ($errors){
                  return [
                      'message' => collect($errors)->join('')
                  ];
              })
          ],400);

      }

      $user = User::where('username', $request->username)->first();
      if($user && Hash::check( $request->password, $user->password)){
          $token = $user->createToken('token', ['role:user'])->plainTextToken;
          return response()->json([
            'status' => 'success',
              'token' => $token,
              'role' => 'user'
          ],200);
      }
     $admin = Administrator::where('username', $request->username)->first();
      if($admin && Hash::check( $request->password, $admin->password)){
          $token =$admin->createToken('token', ['role:admin'])->plainTextToken;
          return response()->json([
              'status' => 'success',
              'token' => $token,
              'role' => 'admin'
          ],200);
      }


      return response()->json([
          "status"=> "invalid",
"message"=> "Wrong username or password"
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
