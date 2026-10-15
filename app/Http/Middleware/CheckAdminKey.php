<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = config('app.admin_key');

// 1. Ключ в .env пустой: закрыто всем
if (empty($key)) {
    abort(403, 'Админ-раздел закрыт');
}

// 2. Ключ в адресе совпал: запоминаем в сессии
if ($request->query('key') === $key) {
    $request->session()->put('is_admin', true);
}

// 3. В сессии нет is_admin: не пускаем
if (! $request->session()->has('is_admin')) {
    abort(403, 'Нужен ключ администратора');
}

return $next($request);
    }
}