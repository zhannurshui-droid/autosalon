@extends('layouts.app')
@section('title', $car->title)

@section('content')
    <h1>{{ $car->title }}</h1>
    <div class="card">
        <p>Номер в каталоге: {{ $car->id }}</p>
        <p>Марка: {{ $car->brand }}</p>
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
    </div>
    <p><a href="{{ route('cars.index') }}">← Назад к списку</a></p>
@endsection
@auth
    @if ($car->attachment)
        <a href="{{ route('cars.attachment', $car) }}" class="btn">Скачать документ</a>
    @endif
@endauth