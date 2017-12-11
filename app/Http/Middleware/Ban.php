<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Ban
{
    /**
     * Данный пользователь не забанен.
     *
     * @param $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            auth()->user()->ban !== null
            && now() < new Carbon(auth()->user()->ban)
        ) {
            return redirect()->route('/#/contact')->with('message', trans('catalog.uHaveBan'));
        }

        return $next($request);
    }
}
