@extends('layouts.app')
@section('title', __('Bookings'))

@section('content')
    <h1>{{ __('Test drive requests') }}</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        $statuses = [
            'new'       => __('New'),
            'processed' => __('Processed'),
            'rejected'  => __('Rejected'),
        ];
    @endphp

    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>{{ __('Client') }}</th>
                <th>{{ __('Car') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->car->title }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->created_at->translatedFormat('j F Y H:i') }}</td>
                    <td>{{ $statuses[$booking->status] ?? $booking->status }}</td>
                    <td>
                        @if ($booking->status === 'new')
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processed">
                                <button type="submit">{{ __('Processed') }}</button>
                            </form>
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit">{{ __('Reject') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">{{ __('No bookings yet.') }}</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $bookings->links() }}
@endsection