<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(Match::class)
            ->withPivot(['type']);
    }

    public function winMatches(): BelongsToMany
    {
        return $this->belongsToMany(Match::class)
            ->wherePivot('type', Match::TYPE_WINNER);
    }

    public function loseMatches(): BelongsToMany
    {
        return $this->belongsToMany(Match::class)
            ->wherePivot('type', Match::TYPE_LOSER);
    }

    public function getRatingAttribute()
    {
        $matches = $this->matches;

        if ($matches->isEmpty()) {
            return 0;
        }

        $winPoints = $matches->where('pivot.type', Match::TYPE_WINNER)->count() * 10;
        $losePoints = $matches->where('pivot.type', Match::TYPE_WINNER)->count() * 5;

        return $winPoints - $losePoints;
    }
}
