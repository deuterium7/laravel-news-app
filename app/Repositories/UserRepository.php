<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\User;
use App\Repositories\Contracts\UserInterface;

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
     * Получить последние комментарии пользователя.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLastCommentsFromUser($id)
    {
        return Comment::with('user')
            ->where('user_id', $id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * Получить новости по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithKeywordsAndPaginate($keywords)
    {
        return User::where('id', '<>', \Auth::user()->id)
            ->where('name', 'LIKE', '%'.$keywords.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
}
