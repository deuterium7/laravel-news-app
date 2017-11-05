<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Авторизация
     *
     * @param $provider
     *
     * @return mixed
     */
    public function login($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    /**
     * Получить ответ от провайдера
     *
     * @param SocialAccountService $service
     * @param $provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(SocialAccountService $service, $provider)
    {
        $driver   = Socialite::driver($provider);
        $user = $service->createOrGetUser($driver, $provider);
        \Auth::login($user, true);

        return redirect()->intended('/home');
    }
}
