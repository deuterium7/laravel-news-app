<?php

namespace App\Http\Controllers;

use App\Contracts\ArticleInterface;
use App\Http\Requests\CategoryRequest;
use App\Mail\CategoryCreate;
use App\Models\Category;
use App\Contracts\CategoryInterface;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    protected $categories;
    protected $articles;

    /**
     * CategoryController constructor.
     *
     * @param CategoryInterface $categories
     * @param ArticleInterface $articles
     */
    public function __construct(CategoryInterface $categories, ArticleInterface $articles)
    {
        $this->categories = $categories;
        $this->articles = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $this->categories->create($request->all());

        Mail::to(\Auth::user()->email)->send(new CategoryCreate((object) $request->all()));

        return redirect()->route('admin.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = $this->articles->getArticlesFromCategory($id);

        return view('categories.show', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categories->update($id, $request->all());

        return redirect()->route('admin.categories');
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
        $this->categories->delete($id);

        return redirect()->back();
    }
}
