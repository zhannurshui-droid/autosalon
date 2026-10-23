@extends('layouts.app')
@section('title', __('Contacts'))

@section('content')
    <h1>{{ __('Contacts') }}</h1>
    <div class="card">
        <p>{{ __('Address') }}: {{ $address }}</p>
        <p>{{ __('Phone') }}: {{ $phone }}</p>
        <p>E-mail: {{ $email }}</p>
    </div>
@endsection