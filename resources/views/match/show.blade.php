@extends('layouts.app')
@section('content')

<div id="main" class="main" role="main">
    <match
        winners-action="{{ route('winners.store') }}"
        :default-players='@json($players)'
    >

    </match>
</div>

@endsection
