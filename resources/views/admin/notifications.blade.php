@extends('layouts.admin')
@section('title', __('Notifications'))

@section('content')
    <h1>{{ __('Notifications') }}</h1>

    @if (auth()->user()->unreadNotifications->count() > 0)
        <form method="POST" action="{{ route('admin.notifications.read') }}">
            @csrf
            <button type="submit">{{ __('Mark all as read') }}</button>
        </form>
    @endif

    @forelse ($notifications as $n)
        <div @class(['unread' => ! $n->read_at])>
            {{ $n->created_at->diffForHumans() }}: {{ $n->data['text'] }}

            @if (! empty($n->data['file']))
                <a href="{{ route('admin.exports.download', $n->data['file']) }}">{{ __('Download') }}</a>
            @endif
        </div>
    @empty
        <p>{{ __('No notifications.') }}</p>
    @endforelse
@endsection