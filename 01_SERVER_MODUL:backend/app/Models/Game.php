<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author'
    ];


public function users():BelongsTo
{
    return $this->belongsTo(User::class);
}

public function toArray()
{

}


}
