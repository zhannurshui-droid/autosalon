@extends('layouts.app')
@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать в «{{ config('app.name') }}»</h1>
    <div class="card">
        <p>Сегодня {{ now()->format('d.m.Y') }}. Подберите автомобиль своей мечты.</p>
        <p><a href="{{ route('cars.index') }}">Смотреть каталог →</a></p>
    </div>
@endsection