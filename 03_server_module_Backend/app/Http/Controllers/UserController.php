<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
            public function index(Request $request)
               {
                  $user = User::all();
                  return response()->json([
                   'users' => $user
                  ],200);
 }

    public function user()
    {

        $usercurrent = Auth::user();

        if (!$usercurrent) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Mengambil data postingan beserta attachment-nya
        $posts = $usercurrent->posts()->with('attachments')->get();

        return response()->json([
            'id' => $usercurrent->id,
            'full_name' => $usercurrent->full_name,
            'username' => $usercurrent->username,
            'bio' => $usercurrent->bio,
            'is_private' => $usercurrent->is_private,
            'created_at' => $usercurrent->created_at,
            'posts_count' => $usercurrent->posts()->count(),
            'posts' => $posts
        ], 200);
    }


 public function show($username)
 {


     if (!Auth::check()) {
         return response()->json(['message' => 'Unauthenticated.'], 401);
     }


     $user = User::where('username', $username)->first();

     if (!$user) {
         return response()->json(['message' => 'User not found'], 404);
     }


     $isYourAccount = Auth::id() === $user->id;


//     $followingStatus = 'not-following';
//     if (Auth::user()->isFollowing($user)) {
//         $followingStatus = 'following';
//     } elseif (Auth::user()->hasRequestedFollow($user)) {
//         $followingStatus = 'requested';
//     }


     $posts = $user->posts()->with('attachments')->get();

     return response()->json([
         'id' => $user->id,
         'full_name' => $user->full_name,
         'username' => $user->username,
         'bio' => $user->bio,
         'is_private' => $user->is_private,
         'created_at' => $user->created_at,
         'is_your_account' => $isYourAccount,
         'posts_count' => $user->posts()->count(),
         'posts' => $posts
     ], 200);
 }




}
