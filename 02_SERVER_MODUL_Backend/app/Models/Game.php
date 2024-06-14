<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function users(): BelongsTo
    {
    return $this->belongsTo(User::class, 'created_by');
    }

    public function gameVersions(): HasMany
    {
        return $this->hasMany(GameVersion::class);
    }
}
