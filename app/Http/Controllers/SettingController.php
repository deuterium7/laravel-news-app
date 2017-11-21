<?php

namespace App\Http\Controllers;

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
        if (in_array($locale, config()->get('app.locales'))) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
