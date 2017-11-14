<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Repositories\Contracts\ArticleInterface;

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
     * Получить все видимые записи из новостей с пагинацией.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllVisibleWithPagination()
    {
        return $this->model->where('visibility', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }

    /**
     * Получить все категории.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllCategories()
    {
        return Category::all()->pluck('name', 'id');
    }

    /**
     * Получить все комментарии новости.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticleComments($id)
    {
        return Comment::with('user')
            ->where('article_id', $id)
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
    public function getAllWithCategoryKeywordsAndPaginate($keywords)
    {
        return Article::with('category')
            ->where('title', 'LIKE', '%'.$keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}