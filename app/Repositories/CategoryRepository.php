<?php

namespace App\Repositories;

use App\Contracts\Category as CategoryContract;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryRepository extends ModelRepository implements CategoryContract
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
     * Получить все категории вида <id-name>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allMap()
    {
        return $this->model->all()->pluck('name', 'id');
    }

    /**
     * Загрузить изображение категории.
     *
     * @param CategoryRequest $request
     *
     * @return string
     */
    public function uploadImage(CategoryRequest $request)
    {
        $put = 'images/categories';
        $image = $request->file('image');

        $upload = public_path($put);
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move($upload, $filename);

        return $put .'/'. $filename;
    }
}
