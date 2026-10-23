@extends('layouts.app')
@section('title', __('Closed'))

@section('content')
    <h1>{{ __('Closed right now') }}</h1>
    <div class="card">
        <p>{{ __('We are open from :from to :to.', ['from' => $from.':00', 'to' => $to.':00']) }}</p>
    </div>
@endsection