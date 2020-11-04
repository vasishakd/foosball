@extends('layouts.app')
@section('content')

<div id="main" class="main">
   <login-page
        logo="{{ asset('images/logo.svg') }}"
        :actions='{
            login: "/api/login",
        }'
        :urls='{
            signUpPage: "/sign-up",
            homePage: "/",
        }'
   ></login-page>
</div>

@endsection
