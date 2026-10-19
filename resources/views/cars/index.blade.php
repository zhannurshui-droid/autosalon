@extends('layouts.app')
@section('title', 'Каталог')

@section('content')
    <h1>Каталог автомобилей</h1>

    <form method="GET" action="{{ route('cars.index') }}" class="search-form">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Название или описание">

    <select name="brand">
        <option value="">Все марки</option>
        @foreach ($brands as $b)
            <option value="{{ $b->id }}" @selected(request('brand') == $b->id)>{{ $b->name }}</option>
        @endforeach
    </select>

    <select name="sort">
        <option value="title"  @selected(request('sort') == 'title')>По названию</option>
        <option value="year"   @selected(request('sort') == 'year')>По году</option>
        <option value="price"  @selected(request('sort') == 'price')>По цене</option>
        <option value="latest" @selected(request('sort') == 'latest')>Сначала новые</option>
    </select>

    <button type="submit">Найти</button>
    <a href="{{ route('cars.index') }}">Сбросить</a>
</form>
    <a href="{{ route('cars.pdf', request()->query()) }}" class="btn">Скачать PDF</a>
    <a href="{{ route('cars.export', request()->query()) }}" class="btn">Скачать Excel</a>

    <ul class="brand-menu">
        @foreach ($brands as $b)
            <li>
                <a href="{{ route('brands.show', $b) }}">{{ $b->name }} ({{ $b->cars_count }})</a>
            </li>
        @endforeach
    </ul>

    @forelse ($cars as $car)
    <x-card :title="$loop->iteration . '. ' . $car->title"
            :url="route('cars.show', $car->id)"
            :badge="$car->price > 50000 ? 'Премиум' : null"
            :image="$car->cover_url"
            :alt="$car->title">
        {{ $car->brand->name }}, {{ $car->year }} год, {{ number_format($car->price, 0, ',', ' ') }} $
    </x-card>
@empty
        <x-alert type="warning">По запросу «{{ request('q') }}» ничего не найдено</x-alert>
    @endforelse
    {{ $cars->links() }}
@endsection