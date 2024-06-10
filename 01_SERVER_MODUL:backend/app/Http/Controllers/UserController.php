<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'totalElement' => $users->count(),
            'content' => $users->map(function ($user){
                return [
                    'username' => $user->username,
                    'last_login_at' => $user->last_login_at,
                    'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $user->updated_at->format('Y-m-d H:i:s')
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:4|max:60'
        ]);

        if(User::where('username', $request->username)->exists()){
            return response()->json([
                'status' => 'invalid',
                'message' => 'Username already exists'
            ]);

        }
        $user = User::create([
            'username' => $request->username,
            'password' => $request->password
        ],201);



        return response()->json([
            'status' => true,
            'username'  => $request->username
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $users = User::find($username);

        return response()->json([

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validator
        $request->validate([
            'username' => 'required|min:4|max:60',
            'password' => 'required|min:4|max:60'
        ]);

        $user = User::find($id);
        //check
         if(User::where('username', $request->username)->exists()){
             return response()->json([
            'status' => 'invalid',
                 'massage' => 'Username already exists'
             ],400);
         }
        //not found
        if(!$user){
            return response()->json([
                'status' => 'not found',
                'message' => ' user not found'
            ]);
        }
        //method

        $user->username = $request->username;
        $user->password =$request->password;
        $user->save();


        //request

        return response()->json([
        'status' => 'success',
            'username'  => $request->username
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
//not found
        if(!$user){
            return response()->json([
                'status' => 'not found',
                'message' => ' user not found'
            ]);
        }
        $user->delete();

        return response()->json([

        ],204);
    }
}
