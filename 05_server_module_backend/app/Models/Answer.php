<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;


    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    public function response()
    {
        return $this->belongsTo(Response::class, 'response_id');
    }
}
