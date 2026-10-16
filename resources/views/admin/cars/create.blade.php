@extends('layouts.admin')
@section('title', 'Новый автомобиль')

@section('content')
    <h1>Новый автомобиль</h1>
    @include('admin.cars._form', ['action' => route('admin.cars.store')])
@endsection