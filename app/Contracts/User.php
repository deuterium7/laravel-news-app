<?php

namespace App\Contracts;

interface User extends Repository
{
    /**
     * Получить всех пользователей для администратора.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersAdmin($keywords);

    /**
     * Получить профиль пользователя.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getUser($id);

    /**
     * Получить пользователя по провайдеру.
     *
     * @param $id
     * @param string $provider
     *
     * @return User
     */
    public function getUserProvider($id, $provider);
}
