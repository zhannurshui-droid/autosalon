@extends('layouts.app')
@section('title', $brand->name)

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->description }}</p>

    @forelse ($brand->cars as $car)
        <x-card :title="$car->title" :url="route('cars.show', $car)">
            {{ __(':year year', ['year' => $car->year]) }}, {{ number_format($car->price, 0, ',', ' ') }} $
        </x-card>
    @empty
        <x-alert type="info">{{ __('No cars of this brand yet.') }}</x-alert>
    @endforelse
@endsection