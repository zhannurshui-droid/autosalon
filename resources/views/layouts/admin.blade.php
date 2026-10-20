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
                <a href="{{ route('admin.cars.index') }}" @class(['active' => request()->routeIs('admin.cars.*')])>Автомобили</a>
                <a href="{{ route('admin.bookings.index') }}" @class(['active' => request()->routeIs('admin.bookings.*')])>Заявки</a>
                <a href="{{ route('admin.notifications') }}">🔔 {{ auth()->user()->unreadNotifications()->count() }}</a>
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
<form method="POST" action="{{ route('logout') }}" style="display:inline">
    @csrf
    <button>Выйти</button>
</form>
            </nav>
        </div>
    </header>

    <main class="container">
    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif
    @if (session('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif

    @yield('content')
</main>

    @include('partials.footer')
</body>
</html>