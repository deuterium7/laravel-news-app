<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\CommentInterface;
use App\Repositories\Contracts\CategoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(ArticleInterface::class, ArticleRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(CommentInterface::class, CommentRepository::class);
    }
}