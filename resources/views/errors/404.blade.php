@extends('layouts.app')
@section('title', '404')

@section('content')
    <div class="error-box">
        <p class="code">404</p>
        <x-alert type="error">Такой страницы нет.</x-alert>
        <p><a href="{{ route('home') }}">← На главную</a></p>
    </div>
@endsection