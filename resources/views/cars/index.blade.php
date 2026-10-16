@extends('layouts.app')
@section('title', 'Каталог')

@section('content')
    <h1>Каталог автомобилей</h1>

    @forelse ($cars as $car)
        <x-card :title="$loop->iteration . '. ' . $car->title"
                :url="route('cars.show', $car->id)"
                :badge="$car->price > 50000 ? 'Премиум' : null">
            {{ $car->brand }}, {{ $car->year }} год, {{ number_format($car->price, 0, ',', ' ') }} $
        </x-card>
    @empty
        <x-alert type="info">Каталог пока пуст.</x-alert>
    @endforelse
@endsection