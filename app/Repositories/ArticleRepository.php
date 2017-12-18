<?php

namespace App\Repositories;

use App\Contracts\Article as ArticleContract;
use App\Models\Article;

class ArticleRepository extends ModelRepository implements ArticleContract
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
     * Обрезать содержание новости.
     *
     * @param $articles
     *
     * @return Article
     */
    public function cutBody($articles)
    {
        foreach ($articles as $article) {
            $article->body = str_limit($article->body, 300);
        }

        return $articles;
    }

    /**
     * Получить видимые новости.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVisibleArticles()
    {
        $articles = $this->model->where('visibility', true)
            ->latest()
            ->paginate(5);

        return $this->cutBody($articles);
    }

    /**
     * Получить все новости для администратора.
     *
     * @param string $keywords
     * @param string $field     [title, category_id, visibility, favorite]
     * @param string $direction [asc, desc]
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesAdmin($keywords, $field, $direction)
    {
        return $this->model->with('category')
            ->where('title', 'LIKE', '%'.$keywords.'%')
            ->orderBy($field, $direction)
            ->paginate(10);
    }

    /**
     * Получить новость.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getArticle($id)
    {
        return $this->model->with(['category', 'user'])
            ->find($id);
    }

    /**
     * Получить все новости из категории.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesCategory($id)
    {
        $articles = $this->model->where('category_id', $id)
            ->where('visibility', true)
            ->latest()
            ->paginate(5);

        return $this->cutBody($articles);
    }

    /**
     * Получить последние избранные новости.
     *
     * @return Article
     */
    public function getArticlesFavorite()
    {
        $articles = $this->model->where('favorite', true)
            ->where('visibility', true)
            ->latest()
            ->limit(5)
            ->get();

        return $this->cutBody($articles);
    }
}
