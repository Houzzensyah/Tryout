<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function follow(Request $request,$username)
    {


        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        // Find the user to follow by username
        $userToFollow = User::where('username', $username)->first();

        if (!$userToFollow) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // Get the authenticated user
        $currentUser = Auth::user();

        // Check if the user is trying to follow themselves
        if ($currentUser->id == $userToFollow->id) {
            return response()->json([
                'message' => 'You are not allowed to follow yourself'
            ], 422);
        }

        // Check if the user is already following
        if ($currentUser->isFollowing($userToFollow)) {
            return response()->json([
                'message' => 'You are already followed',
                'status' => 'following'
            ], 422);
        }

        // Follow the user
        $currentUser->follow($userToFollow);

        return response()->json([
            'message' => 'Follow success',
            'status' => 'following'
        ], 200);
    }


}
