<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    use HasFactory;



    protected $guarded = [];

    public function games():BelongsTo
    {
        return $this->belongsTo(Game::class);

    }

    public function gameVersions(): BelongsTo
    {
        return $this->belongsTo(GameVersion::class, 'game_version_id');
    }


    public  function users() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id' );
    }
}
