<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id
            && Carbon::now()->diffInMinutes($comment->created_at) <= 5;
    }
}
