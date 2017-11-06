<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OwnerRoles
{
    /**
     * Проверка доступа
     *
     * @param $request
     * @param Closure $next
     * @param $role ['user'|'admin']
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            return redirect()->back()->with('message', trans('catalog.plsLogIn'));
        }

        if (
            Auth::user()->ban !== null
            && Carbon::now() < new Carbon(Auth::user()->ban)
        ) {
            return redirect()->back()->with('message', trans('catalog.uHaveBan'));
        }

        return $next($request);
    }
}