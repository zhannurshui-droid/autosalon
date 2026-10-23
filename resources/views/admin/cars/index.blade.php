@extends('layouts.admin')
@section('title', __('Cars'))

@section('content')
    <h1>{{ __('Cars') }}</h1>

    <p><a href="{{ route('admin.cars.create') }}">+ {{ __('Add car') }}</a></p>

    <table>
        <tr>
            <th>№</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Brand') }}</th>
            <th>{{ __('Price, $') }}</th>
            <th>{{ __('Year') }}</th>
            <th>{{ __('Created at') }}</th>
            <th>{{ __('Record author') }}</th>
            <th></th>
        </tr>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->title }}</td>
                <td>{{ $car->brand->name }}</td>
                <td>{{ number_format($car->price, 0, ',', ' ') }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->created_at->translatedFormat('j F Y') }}</td>
                <td>{{ $car->user?->name ?? '—' }}</td>
                <td>
                    @can('update', $car)
                        <a href="{{ route('admin.cars.edit', $car) }}">{{ __('Edit') }}</a>
                    @endcan
                    @can('delete', $car)
                        <form method="POST" action="{{ route('admin.cars.destroy', $car) }}"
                              style="display:inline" onsubmit="return confirm(@js(__('Delete this record?')))">
                            @csrf
                            @method('DELETE')
                            <button>{{ __('Delete') }}</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {{ $cars->links() }}
@endsection