<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class GameSlugController extends Controller
{
    public function update(Request $request, String $slug)
    {
        $request->validate([
            'title' => 'required|min:4|max:60',
            'description' => 'required|min:4|max:60'
        ]);


        $game = Game::find($slug);

        //not found
        if(!$game){
            return response()->json([
                'status' => 'not found',
                'message' => ' game not found'
            ]);
        }
        //method

        $game->title = $request->title;
        $game->description =$request->description;
        $game->save();


        //request

        return response()->json([
            'status' => 'success',

        ],201);
    }

    public function destroy($slug)
    {
        $game = Game::findOrfail($slug);

        $game->delete();

        return response()->json([

        ],204);
    }
}
