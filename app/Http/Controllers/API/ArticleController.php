<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\Article as ArticleContract;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * @var ArticleContract
     */
    protected $articles;

    /**
     * ArticleController constructor.
     *
     * @param ArticleContract  $articles
     */
    public function __construct(ArticleContract $articles)
    {
        $this->articles = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->articles->getVisibleArticles();
    }

    /**
     * Получить все новости для администратора.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function articlesAdmin()
    {
        return $this->articles->getArticlesAdmin();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     *
     * @return \App\Contracts\Model
     */
    public function store(ArticleRequest $request)
    {
        $attributes = $request->all();

        $image = $this->articles->uploadImage($request->image);
        $attributes['image'] = $image;

        return $this->articles->create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \App\Contracts\Model
     */
    public function show($id)
    {
        return $this->articles->getArticle($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param $id
     *
     * @return \App\Contracts\Model
     */
    public function update(ArticleRequest $request, $id)
    {
        $attributes = $request->all();
        $upload = $request->imageNew;

        if ($upload) {
            $image = $this->articles->uploadImage($upload);
            $attributes['image'] = $image;
        }

        $this->articles->update($id, $attributes);

        return response()->json([
            'message' => 'Article updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $this->articles->delete($id);

        return response()->json([
            'message' => 'Article destroy successfully!'
        ], 200);
    }
}
