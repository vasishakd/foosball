<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RandomPlayerController extends Controller
{
    public function index()
    {
        $players = Player::all(['id', 'name']);

        return Inertia::render('RandomPlayer', [
            'defaultPlayers' => $players,
        ]);
    }
}
