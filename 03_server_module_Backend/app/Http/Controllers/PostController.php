<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required',
            'Attachments' => 'required|array',
            'Attachments.*' => 'required|file|mimes:jpg,png,webp,jpeg,gif'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid field",
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $post =  Post::create([
            'user_id' => $user->id,
            'caption' => $request->caption
        ]);

        foreach ($request->file('Attachments') as $file){
            $path = $file->store('posts', 'public');

            Attachment::create([
                'post_id' => $post->id,
                'storage_path' => $path
            ]);

            return response()->json([
                "message"=> "Create post success"
            ],201);
        }
    }

    public function deleted($id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                "message"=> "Post not found"
            ],404);
        }

        if(Auth::id() !== $post->user_id){
            return response()->json([
                "message"=> "Forbidden access"
            ],403);
        }

        $post->delete();
        return response()->json([

        ],204);
    }


    public function index(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'page' => 'min:0|int',
            'size' => 'min:1|int'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid field",
                'errors' => $validator->errors()
            ], 422);
        }

        $page = $request->input('page', 0);
        $size = $request->input('size', 10);


        $posts = Post::with(['attachments', 'user'])
            ->offset($page * $size)
            ->limit($size)
            ->get();

        return response()->json([
            'page'=> $page,
            'size' => $size,
            'posts' => $posts->map(function ($post){
                return [
                    'id' => $post->id,
                    'caption' => $post->caption,
                    'created_at' => $post->created_at,
                    'deleted_At' => $post->deleted_At,
                    'user' => [
                      'id' =>  $post->user->id,
                        'full_name' =>  $post->user->fullname,
                        'username' =>  $post->user->username,
                        'bio' =>  $post->user->bio,
                        'is_private' =>  $post->user->is_private,
                        'created_at' =>  $post->user->created_at,

                    ],
                    'attachments' => $post->attachments->map(function ($attachment){
                        return [
                            'id' => $attachment->id,
                            'storage_path' => $attachment->storage_path
                        ];
                    })

                ];
            })
        ],200);
    }
}
