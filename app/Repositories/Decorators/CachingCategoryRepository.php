<?php

namespace App\Repositories\Decorators;

use App\Contracts\Category as CategoryContract;
use Illuminate\Cache\Repository;

class CachingCategoryRepository implements CategoryContract
{
    /**
     * @var CategoryContract
     */
    protected $category;

    /**
     * @var Repository
     */
    protected $cache;

    /**
     * CachingCategoryRepository constructor.
     *
     * @param CategoryContract $category
     * @param Repository $cache
     */
    public function __construct(CategoryContract $category, Repository $cache)
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
     * @param int   $id
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
     * Получить все категории вида <id-name>.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allMap()
    {
        return $this->category->allMap();
    }
}
