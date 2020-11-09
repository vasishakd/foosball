@extends('layouts.app')

@section('content')

    <div id="main" class="main">
        <?php
            $actions = [
                'login' => route('login'),
            ];

            $urls = [
                'sign_up' => route('register'),
                'home' => route('main'),
            ];
        ?>
        <login-page
                logo="{{ asset('images/logo.svg') }}"
                :actions='@json($actions)'
                :urls='@json($urls)'
        ></login-page>
    </div>

@endsection
