@extends('layouts.app')
@section('title', __('Catalog'))

@section('content')
    <h1>{{ __('Car catalog') }}</h1>

    <form method="GET" action="{{ route('cars.index') }}" class="search-form">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Title or description') }}">

        <select name="brand">
            <option value="">{{ __('All brands') }}</option>
            @foreach ($brands as $b)
                <option value="{{ $b->id }}" @selected(request('brand') == $b->id)>{{ $b->name }}</option>
            @endforeach
        </select>

        <select name="sort">
            <option value="title"  @selected(request('sort') == 'title')>{{ __('By title') }}</option>
            <option value="year"   @selected(request('sort') == 'year')>{{ __('By year') }}</option>
            <option value="price"  @selected(request('sort') == 'price')>{{ __('By price') }}</option>
            <option value="latest" @selected(request('sort') == 'latest')>{{ __('Newest first') }}</option>
        </select>

        <button type="submit">{{ __('Search') }}</button>
        <a href="{{ route('cars.index') }}">{{ __('Reset') }}</a>
    </form>
    <p>{{ trans_choice('messages.cars_found', $cars->total()) }}</p>

    <a href="{{ route('cars.pdf', request()->query()) }}" class="btn">{{ __('Download PDF') }}</a>
    <a href="{{ route('cars.export', request()->query()) }}" class="btn">{{ __('Download Excel') }}</a>

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
                :badge="$car->price > 50000 ? __('Premium') : null"
                :image="$car->cover_url"
                :alt="$car->title">
            {{ $car->brand->name }}, {{ __(':year year', ['year' => $car->year]) }}, {{ number_format($car->price, 0, ',', ' ') }} $
        </x-card>
    @empty
        <x-alert type="warning">
            @if (request('q'))
                {{ __('Nothing found for :query', ['query' => request('q')]) }}
            @else
                {{ __('Catalog is empty') }}
            @endif
        </x-alert>
    @endforelse

    {{ $cars->links() }}
@endsection