@extends('layouts.app')
@section('title', $car->title)

@section('content')
    <h1>{{ $car->title }}</h1>
    <div class="card">
        <p>Номер в каталоге: {{ $car->id }}</p>
        <p>Марка: <a href="{{ route('brands.show', $car->brand) }}">{{ $car->brand->name }}</a></p>
        <p>Цена: {{ number_format($car->price, 0, ',', ' ') }} $</p>
        <p>Год выпуска: {{ $car->year }}</p>
        @if ($car->mileage)
            <p>Пробег: {{ number_format($car->mileage, 0, ',', ' ') }} км</p>
        @endif
        <p>{{ $car->in_stock ? 'В наличии' : 'Под заказ' }}</p>
        @if ($car->description)
            <p>{{ $car->description }}</p>
        @endif
        <img src="{{ $car->cover_url }}" alt="{{ $car->title }}" class="car-photo">

        @auth
            @if ($car->attachment)
                <a href="{{ route('cars.attachment', $car) }}" class="btn">Скачать документ</a>
            @endif
        @endauth
    </div>

    @isset($more)
        @if ($more->count())
            <h2>Ещё из этой марки</h2>
            @foreach ($more as $item)
                <x-card :title="$item->title" :url="route('cars.show', $item)">
                    {{ $item->year }} год, {{ number_format($item->price, 0, ',', ' ') }} $
                </x-card>
            @endforeach
        @endif
    @endisset

    <h2>Записаться на тест-драйв</h2>

    @guest
        <x-alert type="info">
            Войдите, чтобы оставить заявку. <a href="{{ route('login') }}">Войти</a>
        </x-alert>
    @endguest

    @auth
        @error('booking')
            <x-alert type="error">{{ $message }}</x-alert>
        @enderror

        <form method="POST" action="{{ route('bookings.store', $car) }}">
            @csrf

            <label>Телефон
                <input name="phone" value="{{ old('phone') }}" placeholder="+77011234567"
                       @class(['invalid' => $errors->has('phone')])>
            </label>
            @error('phone') <div class="error">{{ $message }}</div> @enderror

            <label>Комментарий
                <textarea name="comment" @class(['invalid' => $errors->has('comment')])>{{ old('comment') }}</textarea>
            </label>
            @error('comment') <div class="error">{{ $message }}</div> @enderror

            <button>Записаться на тест-драйв</button>
        </form>
    @endauth

    <p><a href="{{ route('cars.index') }}">← Назад к списку</a></p>
@endsection