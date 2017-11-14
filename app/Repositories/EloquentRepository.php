<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    /**
     * EloquentRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Получить все записи из репозитория.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Получить одну запись из репозитория.
     *
     * @param int $id
     *
     * @return Model
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Добавить запись в репозиторий.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Обновить запись из репозитория.
     *
     * @param int $id
     * @param array $attributes
     *
     * @return Model
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * Удалить запись из репозитория.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }
}