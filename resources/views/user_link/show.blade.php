@extends('layouts.app')

@section('title', 'User Link')

@section('content')
    <h1>Welcome, {{ $userLink->username }}</h1>
    <p>Your phone number: {{ $userLink->phonenumber }}</p>
    <p>Link expires at: {{ $userLink->token_expires_at }}</p>

    <div class="d-flex gap-3">
        <form method="POST" action="{{ route('userLink.generateNew', $userLink->token) }}">
            @csrf
            <button type="submit" class="btn btn-primary">Generate New Link</button>
        </form>

        <form method="POST" action="{{ route('userLink.deactivate', $userLink->token) }}">
            @csrf
            <button type="submit" class="btn btn-danger">Deactivate Link</button>
        </form>

        <form method="POST" action="{{ route('userLink.lucky.play', $userLink->token) }}">
            @csrf
            <button type="submit" class="btn btn-success">I'm Feeling Lucky</button>
        </form>

        <a href="{{ route('userLink.lucky.history', $userLink->token) }}" class="btn btn-secondary">History</a>
    </div>


    @if(session('lucky'))
        <div class="mt-5">
            <h3>Lucky Result:</h3>
            <p>Random Number: {{ session('lucky')['random'] }}</p>
            <p>Result: {{ session('lucky')['result'] }}</p>
            <p>Win Sum: {{ session('lucky')['winSum'] }}</p>
        </div>
    @endif
@endsection
