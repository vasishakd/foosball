<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Inertia\Inertia;

class MatchController extends Controller
{
    public function index()
    {
        $players = Player::all(['id', 'name']);

        return Inertia::render('Match', [
            'defaultPlayers' => $players,
        ]);
    }
}
