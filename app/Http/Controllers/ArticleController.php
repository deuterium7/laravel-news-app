<?php

namespace App\Http\Controllers;

use App\Mail\ArticleCreateShipped;
use App\Entities\Article;
use App\Entities\Category;
use App\Entities\Comment;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    protected $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->repository->paginate();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        DB::table('articles')->insert([
            'category_id' => $request->category,
            'user_id'     => \Auth::user()->id,
            'title'       => $request->title,
            'image'       => $request->image ? $request->image : 'http://www.veho.ru/img/photo_not_found.gif',
            'body'        => $request->body,
            'visibility'  => $request->visibility !== null ? $request->visibility : false,
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Mail::to(\Auth::user()->email)->send(new ArticleCreateShipped((object) $request->all()));

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

        $comments = Comment::with('user')
            ->where('article_id', $article->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

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
     * @param \Illuminate\Http\Request $request
     * @param Article                  $article
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->image = $request->image;
        $article->body = $request->body;
        $article->visibility = $request->visibility !== null ? $request->visibility : false;
        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back();
    }
}
