<?php

namespace App\Contracts;

interface ArticleInterface extends RepositoryInterface
{
    /**
     * Получить видимые новости с пагинацией.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVisibleWithPagination();

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
    public function getWithCategoryKeywordsAndPagination($keywords);
}
