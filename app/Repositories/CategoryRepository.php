<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Category;
use App\Repositories\Contracts\CategoryInterface;

class CategoryRepository extends EloquentRepository implements CategoryInterface
{
    /**
     * CategoryRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Получить все отсортированным по дате создания.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    /**
     * Получить все новости из категорий.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllArticlesFromCategory($id)
    {
        return Article::with('category')
            ->where('visibility', true)
            ->where('category_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}