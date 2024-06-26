<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class GameSlugController extends Controller
{
    public function update(Request $request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => "min:4|max:60",
            'description' => "min:4|max:60",

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

        $game = Game::where('slug', $slug)->first();

        if(!$game){
            return response()->json([
                "status"=> "not-found",
                "message"=> "User Not found"
            ],404);
        }

        $game->update($params);

        return response()->json([
            'status' => 'success',
            'message' => 'Game updated successfully'
        ], 200);

    }

    public function destroy($slug)
    {
        $game = Game::where('slug', $slug)->first();

        $game->delete();
        return response()->json([

    ], 204);

    }


}
