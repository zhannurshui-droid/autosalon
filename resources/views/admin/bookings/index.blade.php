@extends('layouts.app')
@section('title', 'Заявки')

@section('content')
    <h1>Заявки на тест-драйв</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>Клиент</th>
                <th>Автомобиль</th>
                <th>Телефон</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->car->title }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if ($booking->status === 'new')
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processed">
                                <button type="submit">Обработана</button>
                            </form>
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit">Отклонить</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Заявок пока нет</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $bookings->links() }}
@endsection