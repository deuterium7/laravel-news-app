<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\Contracts\CommentInterface;
use App\Repositories\Contracts\UserInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $article;
    protected $category;
    protected $user;
    protected $comment;

    /**
     * AdminController constructor.
     *
     * @param ArticleInterface  $article
     * @param CategoryInterface $category
     * @param UserInterface     $user
     * @param CommentInterface  $comment
     */
    public function __construct(
        ArticleInterface $article,
        CategoryInterface $category,
        UserInterface $user,
        CommentInterface $comment
    ) {
        $this->article = $article;
        $this->category = $category;
        $this->user = $user;
        $this->comment = $comment;
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
        $articles = $this->article->getAllWithCategoryKeywordsAndPaginate($request->keywords);

        return view('admin.news', compact('articles'));
    }

    /**
     * Показать панель Категорий.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        $categories = $this->category->getAll();

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
        $users = $this->user->getAllWithKeywordsAndPaginate($request->keywords);

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
        $comments = $this->comment->getAllWithKeywordsAndPaginate($request->keywords);

        return view('admin.comments', compact('comments'));
    }
}
