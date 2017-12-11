<?php

namespace App\Contracts;

interface Category extends Repository
{
    /**
     * Получить все категории вида <id-name>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allMap();
}
