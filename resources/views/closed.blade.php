@extends('layouts.app')
@section('title', 'Закрыто')

@section('content')
    <h1>Сейчас закрыто</h1>
    <div class="card">
        <p>Работаем с {{ $from }}:00 до {{ $to }}:00.</p>
    </div>
@endsection