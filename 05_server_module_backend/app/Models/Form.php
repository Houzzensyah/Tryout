<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class, 'form_id');
    }
    public function allowed_domains()
    {
        return $this->hasMany(Allowed_domain::class, 'form_id');
    }
    public function responses()
    {
        return $this->hasMany(Response::class, 'form_id');
    }
}
