<?php

namespace App\Contracts;

interface User extends Repository
{
    /**
     * Получить профиль пользователя с комментариями.
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

    /**
     * Получить пользователей по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersWithKeywords($keywords);
}
