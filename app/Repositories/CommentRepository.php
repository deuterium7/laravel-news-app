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
     * Получить все комметарии администратора.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCommentsAdmin()
    {
        return $this->model->with(['article', 'user'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Получить все комментарии по связанной таблице.
     *
     * @param $id
     * @param string $from === 'article'|'user'
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCommentsClient($id, $from)
    {
        $toggle = $from === 'article' ? 'user' : 'article';

        return $this->model->with($toggle)
            ->where($from.'_id', $id)
            ->orderBy('updated_at', 'desc')
            ->get();
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
