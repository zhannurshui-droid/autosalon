@extends('layouts.admin')
@section('title', 'Автомобили')

@section('content')
    <h1>Все автомобили</h1>
    <table>
        <tr><th>№</th><th>Название</th><th>Цена, $</th><th>Год</th></tr>
        @foreach ($items as $id => $item)
            <tr>
                <td>{{ $id }}</td>
                <td>
                    {{ $item['title'] }}
                    @if ($loop->first)
                        <span class="badge">новая</span>
                    @endif
                </td>
                <td>{{ $item['price'] }}</td>
                <td>{{ $item['year'] }}</td>
            </tr>
        @endforeach
    </table>
@endsection