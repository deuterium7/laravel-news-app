<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

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
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
