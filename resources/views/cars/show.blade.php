@extends('layouts.app')
@section('title', $car->title)

@section('content')
    <h1>{{ $car->title }}</h1>
    <div class="card">
        <p>{{ __('Catalog number') }}: {{ $car->id }}</p>
        <p>{{ __('Brand') }}: <a href="{{ route('brands.show', $car->brand) }}">{{ $car->brand->name }}</a></p>
        <p>{{ __('Price') }}: {{ number_format($car->price, 0, ',', ' ') }} $</p>
        <p>{{ __('Year') }}: {{ $car->year }}</p>
        @if ($car->mileage)
            <p>{{ __('Mileage') }}: {{ __(':count km', ['count' => number_format($car->mileage, 0, ',', ' ')]) }}</p>
        @endif
        <p>{{ $car->in_stock ? __('In stock') : __('On order') }}</p>
        @if ($car->description)
            <p>{{ $car->description }}</p>
        @endif
        <img src="{{ $car->cover_url }}" alt="{{ $car->title }}" class="car-photo">

        @auth
            @if ($car->attachment)
                <a href="{{ route('cars.attachment', $car) }}" class="btn">{{ __('Download document') }}</a>
            @endif
        @endauth
    </div>

    @isset($more)
        @if ($more->count())
            <h2>{{ __('More from this brand') }}</h2>
            @foreach ($more as $item)
                <x-card :title="$item->title" :url="route('cars.show', $item)">
                    {{ __(':year year', ['year' => $item->year]) }}, {{ number_format($item->price, 0, ',', ' ') }} $
                </x-card>
            @endforeach
        @endif
    @endisset

    <h2>{{ __('Book a test drive') }}</h2>

    @guest
        <x-alert type="info">
            {{ __('Log in to submit a request') }}. <a href="{{ route('login') }}">{{ __('Login') }}</a>
        </x-alert>
    @endguest

    @auth
        @error('booking')
            <x-alert type="error">{{ $message }}</x-alert>
        @enderror

        <form method="POST" action="{{ route('bookings.store', $car) }}">
            @csrf

            <label>{{ __('Phone') }}
                <input name="phone" value="{{ old('phone') }}" placeholder="+77011234567"
                       @class(['invalid' => $errors->has('phone')])>
            </label>
            @error('phone') <div class="error">{{ $message }}</div> @enderror

            <label>{{ __('Comment') }}
                <textarea name="comment" @class(['invalid' => $errors->has('comment')])>{{ old('comment') }}</textarea>
            </label>
            @error('comment') <div class="error">{{ $message }}</div> @enderror

            <button>{{ __('Book a test drive') }}</button>
        </form>
    @endauth

    <p><a href="{{ route('cars.index') }}">{{ __('Back to list') }}</a></p>
@endsection