@extends('layouts.app')
@section('title', __('My bookings'))

@section('content')
    @if ($notifications->count())
        <h2>{{ __('Notifications') }}</h2>
        @foreach ($notifications as $n)
            <div @class(['unread' => ! $n->read_at])>
                {{ $n->created_at->diffForHumans() }} — {{ $n->data['text'] }}
            </div>
        @endforeach
    @endif

    <h1>{{ __('My bookings') }}</h1>

    @php
        $statuses = [
            'new'       => __('New'),
            'processed' => __('Processed'),
            'rejected'  => __('Rejected'),
        ];
    @endphp

    @forelse ($bookings as $booking)
        <x-card :title="$booking->car->title" :url="route('cars.show', $booking->car)">
            {{ $booking->created_at->format('d.m.Y H:i') }} — {{ $statuses[$booking->status] ?? $booking->status }}
        </x-card>
    @empty
        <x-alert type="info">{{ __('No bookings yet.') }}</x-alert>
    @endforelse
@endsection