@extends('layouts.admin')
@section('title', 'Изменить марку')

@section('content')
    <h1>Изменить марку</h1>
    @include('admin.brands._form', ['action' => route('admin.brands.update', $brand)])
@endsection