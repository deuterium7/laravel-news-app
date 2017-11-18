<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserInterface;

class UserRepository extends EloquentRepository implements UserInterface
{
    protected $user;

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
     * Получить пользователей по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithKeywordsAndPagination($keywords)
    {
        return $this->model->where('id', '<>', \Auth::user()->id)
            ->where('name', 'LIKE', '%'.$keywords.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
}
