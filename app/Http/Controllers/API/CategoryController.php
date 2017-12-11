<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\Article as ArticleContract;
use App\Contracts\Category as CategoryContract;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * @var CategoryContract
     */
    protected $categories;

    /**
     * @var ArticleContract
     */
    protected $articles;

    /**
     * CategoryController constructor.
     *
     * @param CategoryContract $categories
     * @param ArticleContract  $articles
     */
    public function __construct(CategoryContract $categories, ArticleContract $articles)
    {
        $this->categories = $categories;
        $this->articles = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return $this->categories->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return \App\Contracts\Model
     */
    public function store(CategoryRequest $request)
    {
        $attributes = $request->all();

        $image = $this->categories->uploadImage($request);
        $attributes['image'] = $image;

        return $this->categories->create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function show($id)
    {
        return $this->articles->getArticlesCategory($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $attributes = $request->all();
        $upload = $request->imageNew;

        if ($upload) {
            $image = $this->categories->uploadImage($upload);
            $attributes['image'] = $image;
        }

        $this->categories->update($id, $attributes);

        return response()->json([
            'message' => 'Category updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categories->delete($id);

        return response()->json([
            'message' => 'Category destroy successfully!'
        ], 200);
    }
}
