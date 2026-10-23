@extends('layouts.app')
@section('title', __('Register'))

@section('content')
    <h1>{{ __('Register') }}</h1>

    @if ($errors->any())
        <x-alert type="error">{{ __('Fix the errors in the form (:count)', ['count' => $errors->count()]) }}</x-alert>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>{{ __('Name') }}
            <input name="name" value="{{ old('name') }}"
                   @class(['invalid' => $errors->has('name')])>
        </label>
        @error('name') <div class="error">{{ $message }}</div> @enderror

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

        <label>{{ __('Repeat password') }}
            <input type="password" name="password_confirmation">
        </label>

        <button>{{ __('Register') }}</button>
    </form>
@endsection