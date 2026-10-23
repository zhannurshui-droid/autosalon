<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') — {{ __('Admin') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header header-admin">
        <div class="container">
            <span class="brand">{{ __('Admin') }}</span>
            <nav class="menu">
                <a href="{{ route('home') }}">{{ __('To the site') }}</a>
                <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>{{ __('Dashboard') }}</a>
                <a href="{{ route('admin.cars.index') }}" @class(['active' => request()->routeIs('admin.cars.*')])>{{ __('Cars') }}</a>
                <a href="{{ route('admin.bookings.index') }}" @class(['active' => request()->routeIs('admin.bookings.*')])>{{ __('Bookings') }}</a>
                <a href="{{ route('admin.notifications') }}">🔔 {{ auth()->user()->unreadNotifications()->count() }}</a>
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button>{{ __('Logout') }}</button>
                </form>
                @include('partials.lang-switcher')
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