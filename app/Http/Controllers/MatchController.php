<?php

namespace App\Http\Controllers;

use App\Models\Player;

class MatchController extends Controller
{
    public function show()
    {
        $players = Player::all(['id', 'name']);

        return view('match.show', compact('players'));
    }
}
