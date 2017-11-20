<?php

namespace App\Http\Controllers;

use App\Contracts\Article as ArticleContract;
use App\Contracts\Category as CategoryContract;
use App\Contracts\Comment as CommentContract;
use App\Contracts\User as UserContract;
use Illuminate\Http\Request;

class AdminController extends Controller
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
     * @var UserContract
     */
    protected $users;
    /**
     * @var CommentContract
     */
    protected $comments;

    /**
     * AdminController constructor.
     *
     * @param ArticleContract $articles
     * @param CategoryContract $categories
     * @param UserContract $users
     * @param CommentContract $comments
     */
    public function __construct(
        ArticleContract $articles,
        CategoryContract $categories,
        UserContract $users,
        CommentContract $comments
    ) {
        $this->articles = $articles;
        $this->categories = $categories;
        $this->users = $users;
        $this->comments = $comments;
    }

    /**
     * Показать панель Новостей.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news(Request $request)
    {
        $articles = $this->articles->getArticlesWithKeywords($request->keywords);

        return view('admin.news', compact('articles'));
    }

    /**
     * Показать панель Категорий.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        $categories = $this->categories->all();

        return view('admin.categories', compact('categories'));
    }

    /**
     * Показать панель Пользователей.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users(Request $request)
    {
        $users = $this->users->getUsersWithKeywords($request->keywords);

        return view('admin.users', compact('users'));
    }

    /**
     * Показать панель Комментариев.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments(Request $request)
    {
        $comments = $this->comments->getCommentsWithKeywords($request->keywords);

        return view('admin.comments', compact('comments'));
    }
}
