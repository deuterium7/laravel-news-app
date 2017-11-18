<?php

namespace App\Http\Controllers;

use App\Contracts\ArticleInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CommentInterface;
use App\Contracts\UserInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $articles;
    protected $categories;
    protected $users;
    protected $comments;

    /**
     * AdminController constructor.
     *
     * @param ArticleInterface  $articles
     * @param CategoryInterface $categories
     * @param UserInterface     $users
     * @param CommentInterface  $comments
     */
    public function __construct(
        ArticleInterface $articles,
        CategoryInterface $categories,
        UserInterface $users,
        CommentInterface $comments
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
        $articles = $this->articles->getWithCategoryKeywordsAndPagination($request->keywords);

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
        $users = $this->users->getWithKeywordsAndPagination($request->keywords);

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
        $comments = $this->comments->getWithKeywordsAndPagination($request->keywords);

        return view('admin.comments', compact('comments'));
    }
}
