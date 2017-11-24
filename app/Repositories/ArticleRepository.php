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
     * Получить видимые новости с пагинацией.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVisibleArticles()
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
