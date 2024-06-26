<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json([
            'totalElement' => $user->count(),
            'content' => $user->map(function ($user){
                return [
                    'id' => $user->id,
                    'username' => $user->username,
                    'last_login_at' =>$user->last_login_at,
                    'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),

                ];
            })
        ],200);
    }


    public function show($username)
    {
        $user = User::where('username', $username)->first();

        return response()->json([
            'username' => $user->username
        ]);

    }
    public function showid($id)
    {
        $user = User::find($id);

        return response()->json([
            'username' => $user->username,

        ]);

    }
    public function store(Request $request)
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

        $params = $request->validate([
            'username' => [],
            'password' => [],
        ]);

        $user = User::where('username', $request->username)->first();

        if(User::where('username', $request->username)->exists()){
            return response()->json([
                "status"=>"invalid",
                "message"=> "Username already exists"
            ],400);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ],201);

        return response()->json([
            "status"=> "success",
            "username"=> $params['username']
        ],201);


    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => "min:4|max:60",
            'password' => "min:4|max:60",

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

        $params = $request->validate([
            'username' => ['min:4', 'max:40'],
            'password' => ['min:4', 'max:40'],
        ]);

        $user = User::where('id', $id)->first();

        if(!$user){
            return response()->json([
                "status"=> "not-found",
                "message"=> "User Not found"
            ],404);
        }

        if(User::where('username', $request->username)->whereNot('username', $user->username)->exists()){
            return response()->json([
                "status"=>"invalid",
                "message"=> "Username already exists"
            ],400);
        }

         $user->update($params);

        return response()->json([
            "status"=> "success",
            "username"=> $request->username
        ],201);

    }

    public function delete($id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                "status"=> "not-found",
                "message"=> "User Not found"
            ],404);
        }

        $user->delete();
        return response()->json([

        ],204);
    }

//    public function show($username)
//    {
//        $user = user()->games
//    }
}
