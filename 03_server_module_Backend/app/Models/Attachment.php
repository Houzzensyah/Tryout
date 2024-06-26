<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'post_attachments';
     protected $guarded = [];

     public $timestamps = false;

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

}
