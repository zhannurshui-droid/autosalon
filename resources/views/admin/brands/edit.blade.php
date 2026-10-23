@extends('layouts.admin')
@section('title', __('Edit brand'))

@section('content')
    <h1>{{ __('Edit brand') }}</h1>
    @include('admin.brands._form', ['action' => route('admin.brands.update', $brand)])
@endsection