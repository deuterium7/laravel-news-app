<?php

namespace App\Repositories;

use App\Contracts\Comment as CommentContract;
use App\Models\Comment;

class CommentRepository extends ModelRepository implements CommentContract
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
     * Получить все коментарии для администратора.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsAdmin()
    {
        return $this->model->with(['article', 'user'])
            ->latest()
            ->paginate(10);
    }

    /**
     * Получить все комментарии по связанной таблице.
     *
     * @param $id
     * @param string $from === 'article'|'user'
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsClient($id, $from)
    {
        $toggle = $from === 'article' ? 'user' : 'article';

        return $this->model->with($toggle)
            ->where($from.'_id', $id)
            ->latest()
            ->paginate(5);
    }

    /**
     * Получить комментарии по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsWithKeywords($keywords)
    {
        return $this->model->where('body', 'LIKE', '%'.$keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}
