<?php

namespace App\Http\Middleware;

use Closure;

class OwnerRoles
{
    /**
     * Проверка на право доступа
     *
     * @param $request
     * @param Closure $next
     * @param $role
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!\Auth::check() || !\Auth::user()->hasRole($role)) {
            return redirect('/login');
        }

        return $next($request);
    }
}