@extends('layouts.app')
@section('title', '403')

@section('content')
    <div class="error-box">
        <p class="code">403</p>
        <x-alert type="warning">Доступ запрещён.</x-alert>
        <p>{{ $exception->getMessage() }}</p>
        <p><a href="{{ route('home') }}">← На главную</a></p>
    </div>
@endsection