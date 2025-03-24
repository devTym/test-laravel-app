@extends('layouts.app')

@section('title', 'History')

@section('content')
    <h1>Last "I'm Feeling Lucky" Result</h1>

    @if($results->isEmpty())
        <p>No history yet.</p>
    @else
        <ul>
            @foreach($results as $result)
                <li>
                    Random: {{ $result->random_number }},
                    Result: {{ $result->result }},
                    Win Sum: {{ $result->win_sum }},
                    Date: {{ $result->created_at }}
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
@endsection
