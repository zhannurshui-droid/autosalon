<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'      => 'Введите имя.',
            'email.required'     => 'Введите e-mail.',
            'email.email'        => 'Введите корректный e-mail.',
            'email.unique'       => 'Такой e-mail уже зарегистрирован.',
            'password.required'  => 'Введите пароль.',
            'password.min'       => 'Пароль должен быть не короче 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        $user = User::create($data);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Добро пожаловать, ' . $user->name);
    }
}