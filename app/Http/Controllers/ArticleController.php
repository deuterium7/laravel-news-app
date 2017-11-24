<?php

namespace App\Http\Controllers;

use App\Contracts\Article as ArticleContract;
use App\Contracts\Category as CategoryContract;
use App\Contracts\Comment as CommentContract;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;

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
        $articles = $this->articles->getVisibleArticles();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories->allMap();

        return view('articles.create', compact('categories'));
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

        $this->articles->create($attributes);

        return redirect()->route('admin.news');
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if ($article->visibility == false) {
            return back()->with('message', trans('catalog.blockedNews'));
        }

        $comments = $this->comments->getArticleComments($article->id);

        return view('articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
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

        $this->articles->update($id, $attributes);

        return redirect()->route('articles.index');
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
        $this->articles->delete($id);

        return redirect()->back();
    }
}
