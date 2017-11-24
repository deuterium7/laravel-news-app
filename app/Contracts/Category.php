<?php

namespace App\Contracts;

use App\Http\Requests\CategoryRequest;

interface Category extends Repository
{
    /**
     * Получить все категории вида <id-name>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allMap();

    /**
     * Загрузить изображение категории.
     *
     * @param CategoryRequest $request
     *
     * @return string
     */
    public function uploadImage(CategoryRequest $request);
}
