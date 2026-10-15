@extends('layouts.app')
@section('title', 'О проекте')

@section('content')
    <h1>О проекте</h1>
    <div class="card">
        <p>Автор: {{ $fio }}, группа {{ $group }}</p>
        <p>{{ $info }}</p>
    </div>
@endsection