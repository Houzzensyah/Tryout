<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameVersion extends Model
{
    use HasFactory;
   protected $table = 'game_versions';
    protected $guarded = [];

public function scores(): HasMany
{
return $this->hasMany(Score::class);
}

public function games(): BelongsTo
{
    return $this->belongsTo(Game::class);
}
}
