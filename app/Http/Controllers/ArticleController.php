<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryInterface;
use App\Contracts\CommentInterface;
use App\Http\Requests\ArticleRequest;
use App\Mail\ArticleCreate;
use App\Models\Article;
use App\Contracts\ArticleInterface;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    protected $articles;
    protected $categories;
    protected $comments;

    /**
     * ArticleController constructor.
     *
     * @param ArticleInterface $articles
     * @param CategoryInterface $categories
     * @param CommentInterface $comments
     */
    public function __construct(ArticleInterface $articles, CategoryInterface $categories, CommentInterface $comments)
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
        $articles = $this->articles->getVisibleWithPagination();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories->allPluck();

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
        $this->articles->create($request->all());

        Mail::to(\Auth::user()->email)->send(new ArticleCreate((object) $request->all()));

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
            return redirect()->back()->with('message', trans('catalog.blockedNews'));
        }

        $comments = $this->comments->getCommentsFromArticle($article->id);

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
        $this->articles->update($id, $request->all());

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
