<?php

namespace App\Repositories\Contracts;

interface ArticleInterface extends RepositoryInterface
{
    public function getAllVisibleWithPagination();

    public function getAllCategories();

    public function getArticleComments($id);

    public function getAllWithCategoryKeywordsAndPaginate($keywords);
}