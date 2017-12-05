<?php

namespace App\Contracts;

interface Comment extends Repository
{
    /**
     * Получить все комментарии по связанной таблице.
     *
     * @param $id
     * @param string $from === 'article'|'user'
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getComments($id, $from);

    /**
     * Получить комментарии по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsWithKeywords($keywords);
}
