@extends('layouts.admin')
@section('title', 'Панель')

@section('content')
    <h1>Панель администратора</h1>
    <div class="card"><a href="{{ route('admin.cars') }}">Список автомобилей</a></div>
    <div class="card"><a href="{{ route('admin.cars.create') }}">Добавить автомобиль</a></div>
@endsection