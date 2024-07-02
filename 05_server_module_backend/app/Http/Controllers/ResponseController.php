<?php

namespace App\Http\Controllers;


use App\Models\Answer;
use App\Models\Form;
use App\Models\Response;
use App\Models\User;
use http\Params;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index($slug)
    {
        $forms = Form::where('slug', $slug)->first();

        if(!$forms){
            return response()->json([
                "message"=> "Form not found"
            ],404);
        }

        $responses = Response::with(['user', 'answers'])->get();


        return response()->json([
            "message"=>"Get responses success",
            'responses' => $responses->map(function ($response){
                return[
                    'date' => $response->date,
                    'user' => [
                       'id'=> $response->user->id,
                       'name' => $response->user->name,
                       'email' => $response->user->email,
                       'email_verified_at' =>  $response->user->email_verified_at,
                    ],
                    'answers' => $response->answers,

                ];
            })
        ], 200);
    }


}
