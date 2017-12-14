<?php

namespace App\Http\Controllers\API;

use App\Contracts\Comment as CommentContract;
use App\Contracts\User as UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStatusRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var CommentContract
     */
    protected $comments;

    /**
     * UserController constructor.
     *
     * @param UserContract    $users
     * @param CommentContract $comments
     */
    public function __construct(UserContract $users, CommentContract $comments)
    {
        $this->users = $users;
        $this->comments = $comments;
    }

    /**
     * Авторизованный пользователь.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function auth()
    {
        return auth()->user();
    }

    /**
     * Получить всех пользователей для администратора.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function usersAdmin(Request $request)
    {
        return $this->users->getUsersAdmin($request->keywords);
    }

    /**
     * Профиль Пользователя.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function show($id)
    {
        return $this->users->getUser($id);
    }

    /**
     * Обновить статус Пользователя.
     *
     * @param UserStatusRequest $request
     * @param int               $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserStatusRequest $request, $id)
    {
        $this->users->update($id, $request->all());

        return response()->json([
            'message' => 'User updated successfully!',
        ], 200);
    }

    /**
     * Дать пользователю права Администратора.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function admin($id)
    {
        $this->users->update($id, ['admin' => true]);

        return response()->json([
            'message' => 'User updated successfully!',
        ], 200);
    }
}
