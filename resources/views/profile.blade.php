@extends('layouts.app')
@section('title', 'Мои заявки')

@section('content')
    @if ($notifications->count())
    <h2>Уведомления</h2>
    @foreach ($notifications as $n)
        <div @class(['unread' => ! $n->read_at])>
            {{ $n->created_at->diffForHumans() }} — {{ $n->data['text'] }}
        </div>
    @endforeach
@endif
<h1>Мои заявки</h1>

    @php
        $statuses = ['new' => 'Новая', 'processed' => 'Обработана', 'rejected' => 'Отклонена'];
    @endphp

    @forelse ($bookings as $booking)
        <x-card :title="$booking->car->title" :url="route('cars.show', $booking->car)">
            {{ $booking->created_at->format('d.m.Y H:i') }} — {{ $statuses[$booking->status] ?? $booking->status }}
        </x-card>
    @empty
        <x-alert type="info">Заявок пока нет.</x-alert>
    @endforelse
@endsection