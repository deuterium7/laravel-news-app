<?php

namespace App\Repositories;

use App\Models\Article;
use App\Contracts\ArticleInterface;

class ArticleRepository extends EloquentRepository implements ArticleInterface
{
    /**
     * ArticleRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * Получить видимые новости с пагинацией.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVisibleWithPagination()
    {
        return $this->model->where('visibility', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }

    /**
     * Получить все новости из категории.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesFromCategory($id)
    {
        return $this->model->with('category')
            ->where('visibility', true)
            ->where('category_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }

    /**
     * Получить новости по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithCategoryKeywordsAndPagination($keywords)
    {
        return $this->model->with('category')
            ->where('title', 'LIKE', '%'.$keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}
