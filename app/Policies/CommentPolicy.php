<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Пользователь может редактировать комментарий в течении 5мин после опубликования.
     *
     * @param User    $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function edit(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id
            && now()->diffInMinutes($comment->created_at) <= 5;
    }
}
