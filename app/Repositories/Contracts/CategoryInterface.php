<?php

namespace App\Repositories\Contracts;

interface CategoryInterface extends RepositoryInterface
{
    public function getAllArticlesFromCategory($id);
}