<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Contracts\CommentInterface;

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
     * Получить все комментарии новости.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsFromArticle($id)
    {
        return $this->model->with('user')
            ->where('article_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
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
        return $this->model->with('user')
            ->where('user_id', $id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * Получить комментарии по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithKeywordsAndPagination($keywords)
    {
        return $this->model->where('body', 'LIKE', '%'.$keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}
