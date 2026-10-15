@extends('layouts.app')
@section('title', 'Каталог')

@section('content')
    <h1>Каталог автомобилей</h1>

    @forelse ($items as $id => $item)
        <div class="card">
            {{ $loop->iteration }}.
            <a href="{{ route('cars.show', $id) }}">{{ $item['title'] }}</a>

            @if ($item['price'] > 50000)
                <span class="badge">Премиум</span>
            @endif
        </div>
    @empty
        <div class="card">Каталог пока пуст.</div>
    @endforelse
@endsection