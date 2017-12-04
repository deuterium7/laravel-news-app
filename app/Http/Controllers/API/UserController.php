<?php

namespace App\Http\Controllers\API;

use App\Contracts\Comment as CommentContract;
use App\Contracts\User as UserContract;
use App\Http\Requests\UserStatusRequest;
use App\Models\User;

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
     * Показать профиль Пользователя.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $comments = $this->comments->getUserComments($user->id);

        return view('users.show', compact('user', 'comments'));
    }

    /**
     * Показать форму для бана Пользователя.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ban(User $user)
    {
        return view('users.ban', compact('user'));
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

        return redirect()->route('admin.users');
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

        return redirect()->back();
    }
}
