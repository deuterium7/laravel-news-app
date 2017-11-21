<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->back()->with('message', trans('catalog.plsLogIn'));
        }

        return $next($request);
    }
}
