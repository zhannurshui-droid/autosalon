@extends('layouts.admin')
@section('title', 'Уведомления')

@section('content')
    <h1>Уведомления</h1>

    <form method="POST" action="{{ route('admin.notifications.read') }}">
        @csrf
        <button>Отметить всё прочитанным</button>
    </form>

    @forelse ($notifications as $n)
        <div @class(['unread' => ! $n->read_at])>
            {{ $n->created_at->diffForHumans() }} — {{ $n->data['text'] }}
        </div>
    @empty
        <x-alert type="info">Уведомлений нет.</x-alert>
    @endforelse
@endsection