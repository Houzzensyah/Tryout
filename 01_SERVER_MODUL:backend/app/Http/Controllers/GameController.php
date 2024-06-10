<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {

        $games = Game::all();

        return response()->json([

            'page' => 0,
            'size' => 10,
            'totalElement' => $games->count(),
            'content' => $games->map(function ($game){
                return [
                    'slug' => $game->slug,
                    'title' => $game->title,
                    'description' => $game->description,
                    'thumbnail' => $game->thumbnail,
                    'uploadTimestamp' => $game->uploadTimestamp,
                    'author' => $game->created_by,
                    'scoreCount' => $game->scoreCount,
                    ];

            })
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4|max:60',
            'description' => 'required|min:4|max:60'
        ]);


        $game =Game::create([
            'title' => $request->title,
            'description' => $request->description
        ],201);



        return response()->json([
            'status' => true,
            'slug'  => $game->slug
        ],201);
    }
}
