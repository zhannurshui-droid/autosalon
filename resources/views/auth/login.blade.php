@extends('layouts.app')
@section('title', __('Login'))

@section('content')
    <h1>{{ __('Login') }}</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>E-mail
            <input type="email" name="email" value="{{ old('email') }}"
                   @class(['invalid' => $errors->has('email')])>
        </label>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>{{ __('Password') }}
            <input type="password" name="password"
                   @class(['invalid' => $errors->has('password')])>
        </label>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label>
            <input type="checkbox" name="remember" value="1"> {{ __('Remember me') }}
        </label>

        <button>{{ __('Login') }}</button>
    </form>
@endsection