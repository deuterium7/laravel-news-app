<?php

namespace App\Http\Controllers;

use App\Contracts\User as UserContract;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * @var UserContract
     */
    protected $users;

    /**
     * AuthController constructor.
     *
     * @param UserContract $users
     */
    public function __construct(UserContract $users)
    {
        $this->users = $users;
    }

    /**
     * Связываемся с провайдером.
     *
     * @param $provider
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function socialRedirect($provider)
    {
        try {
            return Socialite::with($provider)->redirect();
        } catch (\InvalidArgumentException $e) {
            return redirect('/login');
        }
    }

    /**
     * Авторизируем пользователя.
     *
     * @param $provider
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function socialCallback($provider)
    {
        $socialUser = Socialite::with($provider)->user();
        $user = $this->users->getUserProvider($socialUser->id, $provider);

        if ($user === null) {
            $user = $this->users->create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail() === '' ?: $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar()
            ]);
        }

        auth()->login($user);

        return redirect('/#/articles');
    }

    /**
     * Выйти из аккаунта.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->logout();

        return redirect('/login');
    }
}
