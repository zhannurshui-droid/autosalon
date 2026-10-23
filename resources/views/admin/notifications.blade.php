@extends('layouts.admin')
@section('title', 'Уведомления')

@section('content')
    <h1>Уведомления</h1>

    @if (auth()->user()->unreadNotifications->count() > 0)
        <form method="POST" action="{{ route('admin.notifications.read') }}">
            @csrf
            <button type="submit">Отметить всё прочитанным</button>
        </form>
    @endif

    @forelse ($notifications as $n)
        <div @class(['unread' => ! $n->read_at])>
            {{ $n->created_at->diffForHumans() }}: {{ $n->data['text'] }}

            @if (! empty($n->data['file']))
                <a href="{{ route('admin.exports.download', $n->data['file']) }}">Скачать</a>
            @endif
        </div>
    @empty
        <p>Уведомлений нет.</p>
    @endforelse
@endsection