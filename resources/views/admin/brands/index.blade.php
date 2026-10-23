@extends('layouts.admin')
@section('title', __('Brands'))

@section('content')
    <h1>{{ __('Brands') }}</h1>

    <p><a href="{{ route('admin.brands.create') }}">+ {{ __('Add brand') }}</a></p>

    <table>
        <tr>
            <th>№</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Created at') }}</th>
            <th></th>
        </tr>
        @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->description }}</td>
                <td>{{ $brand->created_at->translatedFormat('j F Y') }}</td>
                <td>
                    <a href="{{ route('admin.brands.edit', $brand) }}">{{ __('Edit') }}</a>

                    <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}"
                          style="display:inline"
                          onsubmit="return confirm(@js(__('Delete this record?')))">
                        @csrf
                        @method('DELETE')
                        <button>{{ __('Delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $brands->links() }}
@endsection