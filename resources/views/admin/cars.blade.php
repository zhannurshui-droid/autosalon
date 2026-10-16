@extends('layouts.admin')
@section('title', 'Автомобили')

@section('content')
    <h1>Все автомобили</h1>
    <table>
        <tr><th>№</th><th>Название</th><th>Марка</th><th>Цена, $</th><th>Год</th></tr>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>
                    {{ $car->title }}
                    @if ($loop->first)
                        <x-badge>новая</x-badge>
                    @endif
                </td>
                <td>{{ $car->brand }}</td>
                <td>{{ number_format($car->price, 0, ',', ' ') }}</td>
                <td>{{ $car->year }}</td>
            </tr>
        @endforeach
    </table>
@endsection