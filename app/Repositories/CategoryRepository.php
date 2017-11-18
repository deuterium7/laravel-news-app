<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryInterface;

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
     * Получить все отсортированные категории.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    /**
     * Получить все категории вида <значение-ключ>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allPluck()
    {
        return $this->model->all()->pluck('name', 'id');
    }
}
