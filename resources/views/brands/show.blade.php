@extends('layouts.app')
@section('title', $brand->name)

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->description }}</p>

    @forelse ($brand->cars as $car)
        <x-card :title="$car->title" :url="route('cars.show', $car)">
            {{ $car->year }} год, {{ number_format($car->price, 0, ',', ' ') }} $
        </x-card>
    @empty
        <x-alert type="info">Машин этой марки пока нет.</x-alert>
    @endforelse
@endsection