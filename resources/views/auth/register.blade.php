@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>

    @if ($errors->any())
        <x-alert type="error">Исправьте ошибки в форме ({{ $errors->count() }})</x-alert>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Имя
            <input name="name" value="{{ old('name') }}"
                   @class(['invalid' => $errors->has('name')])>
        </label>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label>E-mail
            <input type="email" name="email" value="{{ old('email') }}"
                   @class(['invalid' => $errors->has('email')])>
        </label>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Пароль
            <input type="password" name="password"
                   @class(['invalid' => $errors->has('password')])>
        </label>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label>Повтор пароля
            <input type="password" name="password_confirmation">
        </label>

        <button>Зарегистрироваться</button>
    </form>
@endsection