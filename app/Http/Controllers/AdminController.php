<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Показать панель Новостей.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news(Request $request)
    {
        $articles = Article::with('category')
            ->where('title', 'LIKE', '%'.$request->keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.news', compact('articles'));
    }

    /**
     * Показать панель Категорий.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        $categories = Category::orderBy('id', 'desc')->get();
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
        $users = User::where('id', '<>', \Auth::user()->id)
            ->where('name', 'LIKE', '%'.$request->keywords.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

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
        $comments = Comment::where('body', 'LIKE', '%'.$request->keywords.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.comments', compact('comments'));
    }
}
