<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; font-size: 11px; }
        h1 { font-size: 16px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 4px; vertical-align: middle; }
        th { background: #eee; }
        img { width: 60px; height: 40px; }
        .total { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>{{ config('app.name') }}: каталог на {{ now()->format('d.m.Y') }}</h1>

    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>Фото</th>
                <th>Название</th>
                <th>Марка</th>
                <th>Год</th>
                <th>Цена, $</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($car->cover && file_exists(public_path('storage/' . $car->cover)))
                            <img src="{{ public_path('storage/' . $car->cover) }}" alt="">
                        @endif
                    </td>
                    <td>{{ $car->title }}</td>
                    <td>{{ $car->brand->name }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ number_format($car->price, 0, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Всего записей: {{ $cars->count() }}</p>
</body>
</html>