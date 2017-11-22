<?php

namespace App\Repositories\Decorators;

use App\Contracts\Article as ArticleContract;
use Illuminate\Cache\Repository;

class CachingArticleRepository implements ArticleContract
{
    /**
     * @var ArticleContract
     */
    protected $article;

    /**
     * @var Repository
     */
    protected $cache;

    /**
     * CachingArticleRepository constructor.
     *
     * @param ArticleContract $article
     * @param Repository      $cache
     */
    public function __construct(ArticleContract $article, Repository $cache)
    {
        $this->article = $article;
        $this->cache = $cache;
    }

    /**
     * Получить новости из кэша, иначе из репозитория.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->cache->remember('articles.all', 10, function () {
            return $this->article->all();
        });
    }

    /**
     * Добавить новость.
     *
     * @param array $attributes
     *
     * @return Article
     */
    public function create(array $attributes)
    {
        return $this->article->create($attributes);
    }

    /**
     * Обновить новость.
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return Article
     */
    public function update(int $id, array $attributes)
    {
        return $this->article->update($id, $attributes);
    }

    /**
     * Удалить новость.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->article->delete($id);
    }

    /**
     * Получить видимые новости с пагинацией.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVisibleArticles()
    {
        $page = request('page', 1);

        if ($page == 1) {
            return $this->cache->remember('article.visible', 10, function () {
                return $this->article->getVisibleArticles();
            });
        }

        return $this->article->getVisibleArticles();
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
        return $this->article->getArticlesFromCategory($id);
    }

    /**
     * Получить новости по ключевым словам.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesWithKeywords($keywords)
    {
        return $this->article->getArticlesWithKeywords($keywords);
    }
}
