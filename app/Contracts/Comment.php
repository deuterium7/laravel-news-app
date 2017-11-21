<?php

namespace App\Contracts;

interface Comment extends Repository
{
    /**
     * Получить все комментарии новости.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticleComments($id);

    /**
     * Получить последние комментарии пользователя.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUserComments($id);

    /**
     * Получить комментарии по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsWithKeywords($keywords);
}
