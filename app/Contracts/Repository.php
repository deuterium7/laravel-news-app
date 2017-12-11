<?php

namespace App\Contracts;

interface Repository
{
    /**
     * Получить все записи из репозитория.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Добавить запись в репозиторий.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes);

    /**
     * Обновить запись из репозитория.
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return Model
     */
    public function update(int $id, array $attributes);

    /**
     * Удалить запись из репозитория.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id);

    /**
     * Загрузить изображение.
     *
     * @param $image
     *
     * @return string
     */
    public function uploadImage($image);
}
