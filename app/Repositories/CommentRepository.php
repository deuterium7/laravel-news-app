<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentInterface;

class CommentRepository extends EloquentRepository implements CommentInterface
{
    /**
     * CommentRepository constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * Получить комментарии по ключевым словам с пагинацией
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithKeywordsAndPaginate($keywords)
    {
        return Comment::where('body', 'LIKE', '%'.$keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}