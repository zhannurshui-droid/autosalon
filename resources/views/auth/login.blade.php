@extends('layouts.app')
@section('title', 'Вход')

@section('content')
    <h1>Вход</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <label>
            <input type="checkbox" name="remember" value="1"> Запомнить меня
        </label>

        <button>Войти</button>
    </form>
@endsection