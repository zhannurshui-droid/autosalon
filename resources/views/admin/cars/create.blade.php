@extends('layouts.admin')
@section('title', __('New car'))

@section('content')
    <h1>{{ __('New car') }}</h1>
    @include('admin.cars._form', ['action' => route('admin.cars.store')])
@endsection