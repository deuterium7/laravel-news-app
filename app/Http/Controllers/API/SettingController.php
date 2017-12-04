<?php

namespace App\Http\Controllers\API;

class SettingController extends Controller
{
    /**
     * Сменить язык.
     *
     * @param string $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function locale(string $locale)
    {
        if (in_array($locale, config('app.locales'))) {
            session(['locale' => $locale]);
        }

        return back();
    }
}
