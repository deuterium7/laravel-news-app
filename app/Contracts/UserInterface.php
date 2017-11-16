<?php

namespace App\Contracts;

interface UserInterface extends RepositoryInterface
{
    /**
     * Получить пользователей по ключевым словам с пагинацией.
     *
     * @param string $keywords
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithKeywordsAndPagination($keywords);
}
