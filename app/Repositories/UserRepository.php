<?php

namespace App\Repositories;

use App\Contracts\User as UserContract;
use App\Models\User;

class UserRepository extends ModelRepository implements UserContract
{
    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Получить всех пользователей для администратора.
     *
     * @param string $keywords
     * @param string $field     [name, email, admin, ban, created_at]
     * @param string $direction [asc, desc]
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersAdmin($keywords, $field, $direction)
    {
        return $this->model
            ->where('name', 'LIKE', '%'.$keywords.'%')
            ->orderBy($field, $direction)
            ->paginate(10);
    }

    /**
     * Получить профиль пользователя.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getUser($id)
    {
        return $this->model->find($id);
    }

    /**
     * Получить пользователя по провайдеру.
     *
     * @param $id
     * @param string $provider
     *
     * @return User
     */
    public function getUserProvider($id, $provider)
    {
        return $this->model->where('provider_id', $id)
            ->where('provider', $provider)
            ->first();
    }
}
