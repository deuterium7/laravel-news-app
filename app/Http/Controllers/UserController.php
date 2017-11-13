<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Показать профиль Пользователя.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $comments = Comment::with('user')
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

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
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'ban' => 'required|date|date_format:Y-m-d H:i:s',
        ]);

        $user->ban = $request->ban;
        $user->save();

        return redirect()->route('admin.users');
    }

    /**
     * Дать пользователю права Администратора.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function admin(User $user)
    {
        DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => 2,
        ]);

        return redirect()->back();
    }
}
