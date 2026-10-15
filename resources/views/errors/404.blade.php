@extends('layouts.app')
@section('title', '404')

@section('content')
    <div class="error-box">
        <p class="code">404</p>
        <p>Такой страницы нет.</p>
        <p><a href="{{ route('home') }}">← На главную</a></p>
    </div>
@endsection