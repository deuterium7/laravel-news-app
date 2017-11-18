<?php

namespace App\Repositories\Decorators;

use App\Contracts\CategoryInterface;
use Illuminate\Cache\Repository;

class CachingCategoryRepository implements CategoryInterface
{
    protected $category;
    protected $cache;

    public function __construct(CategoryInterface $category, Repository $cache)
    {
        $this->category = $category;
        $this->cache = $cache;
    }

    /**
     * Получить категории из кэша, иначе из репозитория.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->cache->remember('categories.all', 10, function () {
            return $this->category->all();
        });
    }

    /**
     * Добавить категорию.
     *
     * @param array $attributes
     *
     * @return Category
     */
    public function create(array $attributes)
    {
        $this->cache->flush();

        return $this->category->create($attributes);
    }

    /**
     * Обновить категорию.
     *
     * @param int $id
     * @param array $attributes
     *
     * @return \App\Contracts\Model
     */
    public function update(int $id, array $attributes)
    {
        $this->cache->flush();

        return $this->category->update($id, $attributes);
    }

    /**
     * Удалить категорию.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id)
    {
        $this->cache->flush();

        return $this->category->delete($id);
    }

    /**
     * Получить все категории вида <значение-ключ>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allPluck()
    {
        return $this->category->allPluck();
    }
}