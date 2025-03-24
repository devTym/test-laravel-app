@extends('layouts.app')

@section('title', 'Register Link')

@section('content')
    <h2>Register a New Link</h2>

    @if(session('message'))
        <div>{{ session('message') }}</div>
    @endif

    <form method="POST" action="{{ route('userLink.register') }}" >
        @csrf

        <div class="mb-2">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                @error('username')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="phonenumber" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-4">
                <input type="number"  class="form-control" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}">
                @error('phonenumber')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
