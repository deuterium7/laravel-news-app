<?php

namespace Tests;

trait Catalog
{
    /**
     * Получить последнюю запись из таблицы
     *
     * @param $model
     *
     * @return Model
     */
    public function latest($model)
    {
        return $model::orderBy('id', 'desc')->first();
    }
}