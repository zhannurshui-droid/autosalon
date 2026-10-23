@extends('layouts.admin')
@section('title', 'Панель')

@section('content')
    <h1>Панель администратора</h1>
    <div class="card"><a href="{{ route('admin.cars.index') }}">Список автомобилей</a></div>
    <div class="card"><a href="{{ route('admin.cars.create') }}">Добавить автомобиль</a></div>
    <form method="POST" action="{{ route('admin.exports.catalog') }}">
    @csrf
    <button type="submit">Сформировать PDF в фоне</button>
</form>
@endsection