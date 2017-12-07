<?php

namespace App\Contracts;

use App\Http\Requests\ArticleRequest;

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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
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

    /**
     * Получить новости по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesWithKeywords($keywords);

    /**
     * Загрузить изображение новости.
     *
     * @param ArticleRequest $request
     *
     * @return string
     */
    public function uploadImage(ArticleRequest $request);
}
