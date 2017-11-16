<?php

namespace App\Contracts;

interface CategoryInterface extends RepositoryInterface
{
    /**
     * Получить все категории вида <значение-ключ>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allPluck();
}
