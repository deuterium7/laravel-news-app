<?php

namespace App\Repositories\Contracts;

interface CommentInterface extends RepositoryInterface
{
    public function getAllWithKeywordsAndPaginate($keywords);
}
