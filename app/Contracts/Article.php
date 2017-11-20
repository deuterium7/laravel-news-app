<?php

namespace App\Contracts;

interface Article extends Repository
{
    /**
     * Получить видимые новости.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVisibleArticles();

    /**
     * Получить все новости из категории.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesFromCategory($id);

    /**
     * Получить новости по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesWithKeywords($keywords);
}
