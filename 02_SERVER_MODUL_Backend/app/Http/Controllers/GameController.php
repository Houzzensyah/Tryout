<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GameController extends Controller
{

    public function index()
    {
        $game = Game::all();

        return response()->json([
            'title' => $game->title,
            'description' => $game->description,
            'slug' => $game->slug
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
