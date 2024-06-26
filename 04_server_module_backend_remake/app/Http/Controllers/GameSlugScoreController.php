<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use Illuminate\Http\Request;

class GameSlugScoreController
{
    public function index()
    {
        $scores = Score::with('users')->get();



        return response()->json([
            'score' => $scores->map(function ($score){
                return [
                    'username' =>$score->users->username ,
                    'score' => $score->score,
                    'timestamp' =>$score-> created_at
                    ];
            })
        ]);
    }
    public function store(Request $request, $slug)
    {
        $score = Game::where('slug', $slug)->first();

        $params = $request->validate([
            'score' => [],
        ]);


        $score->create($params);



        return response()->json([
         'status' => 'success'
        ],201);
    }
}
