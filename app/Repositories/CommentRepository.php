<?php

namespace App\Repositories;

use App\Contracts\Comment as CommentContract;
use App\Models\Comment;
use App\Models\Like;

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
     * Получить все комментарии для администратора.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsAdmin($keywords)
    {
        return $this->model->with(['article', 'user'])
            ->where('body', 'LIKE', '%'.$keywords.'%')
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

        return $this->model->with([$toggle, 'likes'])
            ->where($from.'_id', $id)
            ->latest()
            ->paginate(5);
    }

    /**
     * Поставить лайк/дизлайк комментарию.
     *
     * @param $id
     *
     * @return mixed
     */
    public function handleCommentLike($id)
    {
        $userId = auth()->id();
        $like = Like::where('comment_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();

            return response()->json([
                'unliked' => true,
            ]);
        } else {
            return Like::create([
                'comment_id' => $id,
                'user_id'    => $userId,
            ]);
        }
    }
}
