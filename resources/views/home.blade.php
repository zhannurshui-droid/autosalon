@extends('layouts.app')
@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать в «{{ config('app.name') }}»</h1>
    <p>Сегодня {{ now()->format('d.m.Y') }}. Подберите автомобиль своей мечты.</p>
    <p>В каталоге {{ $total }} автомобилей.</p>

    <ul class="brand-menu">
        @foreach ($brands as $b)
            <li><a href="{{ route('brands.show', $b) }}">{{ $b->name }} ({{ $b->cars_count }})</a></li>
        @endforeach
    </ul>

    <h2>Новинки каталога</h2>
    @foreach ($cars as $car)
        <x-card class="card-wide"
                :title="$car->title"
                :url="route('cars.show', $car->id)"
                :badge="$car->price > 50000 ? 'Премиум' : null"
                :image="$car->cover_url"
                :alt="$car->title">
            {{ $car->brand->name }}, {{ $car->year }} год, {{ number_format($car->price, 0, ',', ' ') }} $
        </x-card>
    @endforeach

    <p><a href="{{ route('cars.index') }}">Весь каталог →</a></p>
@endsection