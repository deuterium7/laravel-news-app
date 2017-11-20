<?php

namespace App\Services;

use App\Mail\UserRegistrationWasConfirmed;
use App\Models\User;
use App\Models\UserSocialAccount;
use Illuminate\Support\Carbon;

class SocialAccountService
{
    /**
     * Получить пользователя.
     *
     * @param $providerObject
     * @param $providerName
     *
     * @return User
     */
    public function getUser($providerObject, $providerName)
    {
        $providerUser = $providerObject->user();

        $account = UserSocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        return $account ? $account->user : $this->createUser($providerUser, $providerName);
    }

    /**
     * Создать пользователя.
     *
     * @param $providerUser
     * @param $providerName
     *
     * @return User $user
     */
    public function createUser($providerUser, $providerName)
    {
        $account = new UserSocialAccount([
            'provider_user_id' => $providerUser->getId(),
            'provider'         => $providerName,
        ]);

        $user = User::whereEmail($providerUser->getEmail())->first();

        // Если пользователя не существует в таблице User, добавляем
        if (!$user) {
            $user = User::create([
                'email'    => $providerUser->getEmail(),
                'name'     => $providerUser->getName(),
                'password' => bcrypt('secret'.Carbon::now()),
            ]);

            \Mail::to($user->email)->send(new UserRegistrationWasConfirmed($user));
        }

        $account->user()->associate($user);
        $account->save();

        return $user;
    }
}
