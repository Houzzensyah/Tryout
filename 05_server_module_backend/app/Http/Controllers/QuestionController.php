<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function addQuestion(Request $request, $formslug)
    {
        $params = $request->validate([
            'name' => ['required'],
            'choice_type' => ['required', 'in:short answer,paragraph,date,multiple choice,dropdown,checkboxes'],
            'is_required' => ['nullable', 'boolean'],
            'choices' => ['required_if:choice_type,multiple choice,dropdown,checkboxes','array'],
            'choice.*' => ['array']
        ]);


        $forms = Form::where('slug', $formslug)->first();

        if(!$forms){
            return response()->json([

            ],404);
        }

        if(in_array($params['choice_type'], ['multiple choice' , 'dropdown', 'checkboxes'])){
            $params['choices'] =json_encode($params['choices']);

        }else{
            $params['choices'] = null;
        }


        $questions = $forms->questions()->create($params);


        return response()->json([
            "message"=> "Add question success",
            'question' => [
                "name"=> $questions->name,
        "choice_type"=> $questions->choice_type,
        "is_required"=> $questions->is_required,
        "choices"=> $questions->choices ? json_decode($questions->choices) : null,
        "form_id"=> $questions->form_id,
        "id"=> $questions->id
            ]
        ],200);

    }

    public function removeQuestion($slug, $id)
    {
        $forms = Form::where('slug', $slug)->first();

        if(!$forms){
            return response()->json([
                "message"=> "Form not found"
            ],404);
        }

        $questions = Question::where('id', $id)->first();

        if(!$questions){
            return response()->json([
                "message"=> "Question not found"
            ],404);
        }

        $questions->delete();

        return response()->json([
            "message"=> "Remove question success"
        ],200);
    }
}
