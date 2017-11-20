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
     * Получить пользователей по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersWithKeywords($keywords)
    {
        return $this->model->where('id', '<>', auth()->user()->id)
            ->where('name', 'LIKE', '%'.$keywords.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
}
