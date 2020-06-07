<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use const http\Client\Curl\AUTH_ANY;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect(route('admin.login'));
        }

        if (!Auth::guest() && Auth::user()->status == '1') {
            return $next($request);

        } else {
            return redirect(route('admin.login'))->with('error', 'Hesabınız yönetici tarafından devre dışı bırakılmıştır!');
        }

        return redirect(route('admin.login'));

    }
}
