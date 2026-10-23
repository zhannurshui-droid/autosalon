@extends('layouts.app')
@section('title', __('About'))

@section('content')
    <h1>{{ __('About') }}</h1>
    <div class="card">
        <p>{{ __('Author: :name, group :group', ['name' => $fio, 'group' => $group]) }}</p>
        <p>{{ $info }}</p>
    </div>
@endsection