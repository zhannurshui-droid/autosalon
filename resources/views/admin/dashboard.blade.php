@extends('layouts.admin')
@section('title', __('Dashboard'))

@section('content')
    <h1>{{ __('Admin panel') }}</h1>
    <div class="card"><a href="{{ route('admin.cars.index') }}">{{ __('List of cars') }}</a></div>
    <div class="card"><a href="{{ route('admin.cars.create') }}">{{ __('Add car') }}</a></div>
    <form method="POST" action="{{ route('admin.exports.catalog') }}">
        @csrf
        <button type="submit">{{ __('Generate PDF in background') }}</button>
    </form>
@endsection