<?php

namespace App\Contracts;

interface CommentInterface extends RepositoryInterface
{
    /**
     * Получить все комментарии новости.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsFromArticle($id);

    /**
     * Получить последние комментарии пользователя.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLastCommentsFromUser($id);

    /**
     * Получить комментарии по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithKeywordsAndPagination($keywords);
}
