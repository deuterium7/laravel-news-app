<?php

namespace App\Repositories\Contracts;

interface UserInterface extends RepositoryInterface
{
    public function getLastCommentsFromUser($id);

    public function getAllWithKeywordsAndPaginate($keywords);
}
