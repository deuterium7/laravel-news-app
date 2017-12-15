<?php

namespace App\Contracts;

interface Comment extends Repository
{
    /**
     * Получить все комментарии для администратора.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsAdmin($keywords);

    /**
     * Получить все комментарии клиента.
     *
     * @param $id
     * @param string $from === 'article'|'user'
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsClient($id, $from);

    /**
     * Поставить лайк/дизлайк комментарию.
     *
     * @param $id
     */
    public function handleCommentLike($id);
}
