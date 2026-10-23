<nav class="menu">
    <a href="{{ route('home') }}" @class(['active'=>request()->routeIs('home')])>{{ __('Home') }}</a>
    <a href="{{ route('cars.index') }}" @class(['active'=>request()->routeIs('cars.*')])>{{ __('Catalog') }}</a>
    <a href="{{ route('about') }}" @class(['active'=>request()->routeIs('about')])>{{ __('About') }}</a>
    <a href="{{ route('contacts') }}" @class(['active'=>request()->routeIs('contacts')])>{{ __('Contacts') }}</a>
    <a href="{{ route('rules') }}" @class(['active'=>request()->routeIs('rules')])>{{ __('Rules') }}</a>
    <a href="{{ route('booking') }}" @class(['active'=>request()->routeIs('booking')])>{{ __('Test drive') }}</a>
    @guest
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
        <a href="{{ route('register') }}">{{ __('Register') }}</a>
    @endguest

    @auth
        <span>{{ auth()->user()->name }}</span>
        @can('admin-panel')
            <a href="{{ route('admin.dashboard') }}">{{ __('Admin panel') }}</a>
        @endcan
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button>{{ __('Logout') }}</button>
        </form>
    @endauth
    @include('partials.lang-switcher')
</nav>