<?php

namespace App\Http\Controllers;

use App\Models\Allowed_domain;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:Forms,slug'],
            'allowed_domains' => ['array'],
            'description' => ['nullable'],
            'limit_one_response' =>['nullable', 'boolean']
        ]);

        $form = Form::create([
            'name' => $params['name'],
            'slug' =>$params['slug'],
            'description' =>$params['description'],
            'limit_one_response' =>$params['limit_one_response'],
            'creator_id' => auth()->id()
        ]);

        foreach ($params['allowed_domains'] as $domain){
            Allowed_domain::create([
                'form_id' => $form->id,
                'domain' => $domain
            ]);

        }

        return response()->json([
            "message"=> "Create form success",
            'form' => [
                'name' => $form->name,
                'slug' =>$form->slug,
                'description' =>$form->description,
                'limit_one_response' =>$form->limit_one_response,
                'creator_id' => auth()->id(),
                'id' => $form->id,
            ]
        ],200);


    }

    public function index(Request $request)
    {
        $form = Form::with('allowed_domains')->get();

        return response()->json([
            "message"=> "Get all forms success",
            'forms' => $form->map(function ($form){
                return [
                    'id' => $form->id,
                    'name' => $form->name,
                    'slug' => $form->slug,
                    'description' => $form->description,
                    'limit_one_response' => $form->limit_one_response,
                    'creator_id' => $form->creator_id
                ];
            })
        ], 200);
    }

    public function show($slug)
    {
         $forms = Form::with(['allowed_domains', 'questions'])->where('slug', $slug)->first();

         if(!$forms){
             return response()->json([
                 "message"=> "Form not found",
             ],404);
         }

         $formAll = [
             'id' => $forms->id,
             'name' => $forms->name,
             'slug' => $forms->slug,
             'description' => $forms->description,
             'limit_one_response' => $forms->limit_one_response,
             'creator_id' => $forms->creator_id,
             'allowed_domains' => $forms->allowed_domains->pluck('domain'),
             'questions' => $forms->questions->map(function ($question){
                 return [
                     "id"=> $question->id,
                "form_id"=> $question->form_id,
                "name"=> $question->name,
                "choice_type"=> $question->choice_type,
                "choices"=> $question->choices,
                "is_required"=> $question->is_required
                 ];
             })

         ];

         return response()->json([
             "message"=> "Get form success",
             'form' => $formAll,
         ]);
    }
}
