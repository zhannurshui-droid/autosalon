@extends('layouts.admin')
@section('title', __('New brand'))

@section('content')
    <h1>{{ __('New brand') }}</h1>
    @include('admin.brands._form', ['action' => route('admin.brands.store')])
@endsection