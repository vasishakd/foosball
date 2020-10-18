<?php

namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'players' => 'required',
            'winners' => 'required',
            'players.*.id' => 'exists:players,id',
            'winners.*' => 'exists:players,id',
        ]);

        $players = array_column($data['players'], 'id');

        $match = Match::create();

        foreach ($players as $player) {
            $playerType = in_array($player, $data['winners']) ? Match::TYPE_WINNER : Match::TYPE_LOSER;
            $match->players()->attach($player, ['type' => $playerType]);
        }

        return response()->json();
    }
}
