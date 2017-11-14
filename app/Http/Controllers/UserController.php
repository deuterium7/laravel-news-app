<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleUser;
use App\Http\Requests\UserStatusRequest;
use App\Repositories\Contracts\UserInterface;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
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
        $comments = $this->user->getLastCommentsFromUser($user->id);

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
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserStatusRequest $request, $id)
    {
        $this->user->update($id, $request->all());

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
        RoleUser::create([
            'user_id' => $id,
            'role_id' => 2,
        ]);

        return redirect()->back();
    }
}
