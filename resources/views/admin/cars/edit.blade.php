@extends('layouts.admin')
@section('title','Изменить автомобиль')

@section('content')
   <h1>Изменить: {{ $car->title }}</h1>
   @include('admin.cars._form',['action'=>route('admin.cars.update',$car)])
@endsection