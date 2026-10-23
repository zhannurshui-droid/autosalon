@extends('layouts.app')
@section('title', __('Rules'))

@section('content')
    <h1>{{ __('Dealership rules') }}</h1>
    <div class="card">
        <p>{{ __("Test drives are held by prior appointment with a valid driver's license.") }}</p>
    </div>
@endsection