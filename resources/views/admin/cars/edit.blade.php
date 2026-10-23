@extends('layouts.admin')
@section('title', __('Edit car'))

@section('content')
    <h1>{{ __('Edit: :title', ['title' => $car->title]) }}</h1>
    @include('admin.cars._form', ['action' => route('admin.cars.update', $car)])
@endsection