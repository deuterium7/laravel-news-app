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
     * Получить все новости для администратора.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesAdmin();

    /**
     * Получить новость с комментариями.
     *
     * @param $id
     *
     * @return Model
     */
    public function getArticle($id);

    /**
     * Получить все новости из категории.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesCategory($id);
}
