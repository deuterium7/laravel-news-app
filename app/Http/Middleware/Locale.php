<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sessionLocale = session('locale');

        if (in_array($sessionLocale, config('app.locales'))) {
            $locale = $sessionLocale;
        } else {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
