<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Match extends Model
{
    use HasFactory;

    const TYPE_LOSER = 'loser';
    const TYPE_WINNER = 'winner';

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
            ->withPivot(['type']);
    }

    public function winners()
    {
        return $this->belongsToMany(Player::class)
            ->wherePivot('type', static::TYPE_WINNER);
    }

    public function losers()
    {
        return $this->belongsToMany(Player::class)
            ->wherePivot('type', static::TYPE_LOSER);
    }
}
