@extends('layouts.app')

@section('content')

    <div id="main" class="main">
        <?php
        $actions = [
            'randomize' => '/api/randomize',
        ];

        $urls = [
            'game' => '#!',
        ];
        $players = [
            [
                'id' => 0,
                'name' => 'Player 1',
            ],
            [
                'id' => 1,
                'name' => 'Player 2',
            ],
            [
                'id' => 2,
                'name' => 'Player 3',
            ],
            [
                'id' => 3,
                'name' => 'Player 4',
            ],
            [
                'id' => 4,
                'name' => 'Player 5',
            ],
        ];
        ?>
        <home-page
            :actions='@json($actions)'
            :urls='@json($urls)'
            :players='@json($players)'
        ></home-page>
    </div>

@endsection
