<?php

namespace App\Http\Middleware;

use Closure;

class AdminRole
{
    /**
     * Данный пользователь администратор.
     *
     * @param $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->admin) {
            return back()->with('message', trans('catalog.plsLogIn'));
        }

        return $next($request);
    }
}
