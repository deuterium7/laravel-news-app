<?php

namespace Tests;

use App\Models\RoleUser;
use App\Models\User;

trait UserStub
{
    /**
     * Создать пользователя-заглушку.
     *
     * @param string $role
     *
     * @return User
     */
    public function createUserStub(string $role = 'user')
    {
        $user = factory(User::class)->create();
        $this->setRights($user->id, $role);

        return $user;
    }

    /**
     * Дать пользователю соответствующие права.
     *
     * @param $id
     *
     * @param string $role
     */
    public function setRights($id, string $role = 'user')
    {
        if ($role == 'admin') {
            RoleUser::create([
                'user_id' => $id,
                'role_id' => 2
            ]);
        }

        RoleUser::create([
            'user_id' => $id,
            'role_id' => 1
        ]);
    }
}