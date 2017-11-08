<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

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
            ->limit(5)
            ->get();

        return view('users.show', compact('user', 'comments'));
    }
}
