@extends('layouts.admin')
@section('title', 'Марки')

@section('content')
    <h1>Марки</h1>

    <p><a href="{{ route('admin.brands.create') }}">+ Добавить марку</a></p>

    <table>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Создана</th>
            <th></th>
        </tr>
        @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->description }}</td>
                <td>{{ $brand->created_at->format('d.m.Y') }}</td>
                <td>
                    <a href="{{ route('admin.brands.edit', $brand) }}">Изменить</a>

                    <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}"
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

    {{ $brands->links() }}
@endsection