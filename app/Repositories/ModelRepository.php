<?php

namespace App\Repositories;

use App\Contracts\Repository as RepositoryContract;
use Illuminate\Database\Eloquent\Model;

abstract class ModelRepository implements RepositoryContract
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * ModelRepository constructor.
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
    public function all()
    {
        return $this->model->all();
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
     * @param int   $id
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
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }
}
