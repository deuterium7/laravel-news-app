<?php

namespace App\Contracts;

interface Comment extends Repository
{
    /**
     * Получить все комметарии администратора.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCommentsAdmin();

    /**
     * Получить все комментарии клиента.
     *
     * @param $id
     * @param string $from === 'article'|'user'
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCommentsClient($id, $from);

    /**
     * Получить комментарии по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsWithKeywords($keywords);
}
