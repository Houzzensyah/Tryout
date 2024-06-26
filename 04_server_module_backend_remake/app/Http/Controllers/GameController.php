<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GameController extends Controller
{

    public function index()
    {
        $admin = Game::with(['users', 'gameVersions'])->get();
        return response()->json([
            'totalElement' =>$admin->count(),
            'content' =>$admin->map(function ($admin){
                return [
                    'title' => $admin->title,
                    'slug' =>$admin->slug,
                    'description' => $admin->description,
                    'author' => $admin->users->username,


                ];
            })
        ],200);
    }

    public function indexUser(Request $request)
    {
        $admin = $request->user()->Game;

        return response()->json([
          'data' => $admin
        ],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => "required|min:4|max:60",
            'description' => "required|min:4|max:60",

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
            'title' => [],
            'description' => [],
        ]);

        $params['slug'] = Str::slug($params['title']);


        if(Game::where('slug', $params['slug'])->first()){
            return response()->json([
                "status"=>"invalid",
                "message"=> "Game title already exists"
            ],400);
        }


        $request->user()->games()->create($params);


        return response()->json([
            "status"=> "success",
            "slug"=> $params['slug']
        ],201);


    }

}
