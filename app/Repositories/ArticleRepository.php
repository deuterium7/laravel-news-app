<?php

namespace App\Repositories;

use App\Contracts\Article as ArticleContract;
use App\Http\Requests\ArticleRequest;
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
     * @return Article
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesAdmin()
    {
        return $this->model->with('category')
            ->latest()
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
     * Получить новости по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticlesWithKeywords($keywords)
    {
        return $this->model->with('category')
            ->where('title', 'LIKE', '%'.$keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }

    /**
     * Загрузить изображение новости.
     *
     * @param ArticleRequest $request
     *
     * @return string
     */
    public function uploadImage(ArticleRequest $request)
    {
        $put = 'images/articles';
        $image = $request->file('image');

        $upload = public_path($put);
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image->move($upload, $filename);

        return $put.'/'.$filename;
    }
}
