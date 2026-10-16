@extends('layouts.admin')
@section('title', 'Автомобили')

@section('content')
    <h1>Автомобили</h1>

    <p><a href="{{ route('admin.cars.create') }}">+ Добавить автомобиль</a></p>

    <table>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Марка</th>
            <th>Цена, $</th>
            <th>Год</th>
            <th>Создан</th>
            <th></th>
        </tr>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->title }}</td>
                <td>{{ $car->brand->name }}</td>
                <td>{{ number_format($car->price, 0, ',', ' ') }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->created_at->format('d.m.Y') }}</td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car) }}">Изменить</a>

                    <form method="POST" action="{{ route('admin.cars.destroy', $car) }}"
                          style="display:inline"
                          onsubmit="return confirm('Удалить запись?')">
                        @csrf
                        @method('DELETE')
                        <button>Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $cars->links() }}
@endsection