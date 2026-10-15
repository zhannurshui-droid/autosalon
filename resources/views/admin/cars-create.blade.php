@extends('layouts.admin')
@section('title', 'Добавить')

@section('content')
    <h1>Добавить автомобиль</h1>
    <div class="card">
        <p>Название: <input type="text"></p>
        <p>Цена: <input type="text"></p>
        <p>Год: <input type="text"></p>
        <button type="button">Сохранить</button>
    </div>
@endsection