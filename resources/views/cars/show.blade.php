@extends('layouts.app')
@section('title', $car['title'])

@section('content')
    <h1>{{ $car['title'] }}</h1>
    <div class="card">
        <p>Номер в каталоге: {{ $id }}</p>
        <p>Цена: {{ $car['price'] }} $</p>
        <p>Год выпуска: {{ $car['year'] }}</p>
    </div>
    <p><a href="{{ route('cars.index') }}">← Назад к списку</a></p>
@endsection