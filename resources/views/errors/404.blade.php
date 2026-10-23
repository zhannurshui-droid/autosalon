@extends('layouts.app')
@section('title', '404')

@section('content')
    <div class="error-box">
        <p class="code">404</p>
        <x-alert type="error">{{ __('Page not found.') }}</x-alert>
        <p><a href="{{ route('home') }}">{{ __('← To home') }}</a></p>
    </div>
@endsection