<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string'],
            'read_only' => ['nullable', 'boolean'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверный e-mail или пароль.'],
            ]);
        }

        // права по роли: user только читает, admin и editor ещё и пишут
        $abilities = in_array($user->role, ['admin', 'editor'])
            ? ['read', 'write']
            : ['read'];

        // read_only=true оставляет только чтение, даже администратору
        if ($request->boolean('read_only')) {
            $abilities = ['read'];
        }

        $token = $user->createToken('api', $abilities)->plainTextToken;

        return response()->json([
            'token'      => $token,
            'token_type' => 'Bearer',
            'abilities'  => $abilities,
            'user'       => new UserResource($user),
        ]);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Вы вышли из системы']);
    }

    public function logoutAll(Request $request)
    {
        $count = $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Вы вышли на всех устройствах',
            'deleted' => $count,
        ]);
    }
}