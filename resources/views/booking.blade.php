@extends('layouts.app')
@section('title', __('Test drive'))

@section('content')
    <h1>{{ __('Book a test drive') }}</h1>
    <div class="card">
        <p>{{ __('Your name') }}: <input type="text"></p>
        <p>{{ __('Phone') }}: <input type="text"></p>
        <button type="button">{{ __('Sign up') }}</button>
    </div>
@endsection