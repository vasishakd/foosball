@extends('layouts.app')

@section('content')

    <div id="main" class="main">
        <?php
        $actions = [
            'registration' => '/api/registration',
        ];

        $urls = [
            'login' => route('login'),
            'home' => '#!',
        ];
        ?>
        <registration-page
            :actions='@json($actions)'
            :urls='@json($urls)'
        ></registration-page>
    </div>

@endsection
