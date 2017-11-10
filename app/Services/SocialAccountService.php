<?php

namespace App\Services;

use App\Models\UserSocialAccount;
use App\Models\User;

class SocialAccountService
{
    /**
     * Получить пользователя
     *
     * @param $providerObject
     * @param $providerName
     *
     * @return mixed
     */
    public function createOrGetUser($providerObject, $providerName)
    {
        $providerUser = $providerObject->user();

        $account = UserSocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new UserSocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::createBySocialProvider($providerUser);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }
    }
}