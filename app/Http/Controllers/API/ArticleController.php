<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\Article as ArticleContract;
use App\Contracts\Category as CategoryContract;
use App\Contracts\Comment as CommentContract;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * @var ArticleContract
     */
    protected $articles;

    /**
     * @var CategoryContract
     */
    protected $categories;

    /**
     * @var CommentContract
     */
    protected $comments;

    /**
     * ArticleController constructor.
     *
     * @param ArticleContract  $articles
     * @param CategoryContract $categories
     * @param CommentContract  $comments
     */
    public function __construct(ArticleContract $articles, CategoryContract $categories, CommentContract $comments)
    {
        $this->articles = $articles;
        $this->categories = $categories;
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->articles->getVisibleArticles();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleRequest $request)
    {
        $attributes = $request->all();

        $image = $this->articles->uploadImage($request);
        $attributes['image'] = $image;

        return $this->articles->create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->articles->getArticle($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param int            $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, $id)
    {
        $attributes = $request->all();

        if ($request->hasFile('image')) {
            $image = $this->articles->uploadImage($request);
            $attributes['image'] = $image;
        }

        return $this->articles->update($id, $attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->articles->delete($id);
    }
}
