@extends('layouts.admin')
@section('title', 'Новая марка')

@section('content')
    <h1>Новая марка</h1>
    @include('admin.brands._form', ['action' => route('admin.brands.store')])
@endsection