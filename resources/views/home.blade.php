@extends('layouts.app')
@section('title', __('Home'))

@section('content')
    <h1>{{ __('Welcome to «:name»', ['name' => config('app.name')]) }}</h1>
    <p>{{ __('Today is :date. Choose the car of your dreams.', ['date' => now()->translatedFormat('j F Y')]) }}</p>
    <p>{{ trans_choice('messages.catalog_total', $total) }}</p>

    <ul class="brand-menu">
        @foreach ($brands as $b)
            <li><a href="{{ route('brands.show', $b) }}">{{ $b->name }} ({{ $b->cars_count }})</a></li>
        @endforeach
    </ul>

    <h2>{{ __('Catalog highlights') }}</h2>
    @foreach ($cars as $car)
        <x-card class="card-wide"
                :title="$car->title"
                :url="route('cars.show', $car->id)"
                :badge="$car->price > 50000 ? __('Premium') : null"
                :image="$car->cover_url"
                :alt="$car->title">
            {{ $car->brand->name }}, {{ __(':year year', ['year' => $car->year]) }}, {{ number_format($car->price, 0, ',', ' ') }} $
        </x-card>
    @endforeach

    <p><a href="{{ route('cars.index') }}">{{ __('Full catalog →') }}</a></p>
@endsection