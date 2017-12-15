<?php

namespace App\Http\Controllers\API;

use App\Contracts\Article as ArticleContract;
use App\Events\ArticleWasViewed;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @var ArticleContract
     */
    protected $articles;

    /**
     * ArticleController constructor.
     *
     * @param ArticleContract $articles
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
    public function articlesAdmin(Request $request)
    {
        return $this->articles->getArticlesAdmin($request->keywords);
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
        $article = $this->articles->getArticle($id);
        event(new ArticleWasViewed($article));

        return $article;
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
            $attributes['image'] = $this->articles->uploadImage($upload);
            $this->articles->deleteFile($request->image);
        }

        $this->articles->update($id, $attributes);

        return response()->json([
            'message' => 'Article updated successfully!',
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
            'message' => 'Article destroy successfully!',
        ], 200);
    }
}
