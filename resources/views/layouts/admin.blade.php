<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') --- Админка</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header header-admin">
        <div class="container">
            <span class="brand">Админка</span>
            <nav class="menu">
                <a href="{{ route('home') }}">На сайт</a>
                <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Панель</a>
                <a href="{{ route('admin.cars') }}" @class(['active' => request()->routeIs('admin.cars*')])>Автомобили</a>
                <a href="{{ route('admin.logout') }}">Выход</a>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>