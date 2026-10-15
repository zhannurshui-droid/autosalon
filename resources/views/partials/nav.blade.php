<nav class="menu">
    <a href="{{ route('home') }}" @class(['active'=>request()->routeIs('home')])>Главная</a>
    <a href="{{ route('cars.index') }}" @class(['active'=>request()->routeIs('cars')])>Каталог</a>
    <a href="{{ route('about') }}" @class(['active'=>request()->routeIs('about')])>О Проекте</a>
    <a href="{{ route('contacts') }}" @class(['active'=>request()->routeIs('contacts')])>Контакты</a>
    <a href="{{ route('rules') }}" @class(['active'=>request()->routeIs('rules')])>Правила</a>
    <a href="{{ route('booking') }}" @class(['active'=>request()->routeIs('booking')])>Тест-Драйв</a>
</nav>