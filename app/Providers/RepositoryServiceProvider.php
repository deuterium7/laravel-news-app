<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Contracts\ArticleInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CommentInterface;
use App\Contracts\UserInterface;
use App\Repositories\Decorators\CachingArticleRepository;
use App\Repositories\Decorators\CachingCategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton(ArticleInterface::class, function() {
            $eloquentRepository = new ArticleRepository(new Article());
            $cachingRepository = new CachingArticleRepository($eloquentRepository, $this->app['cache.store']);

            return $cachingRepository;
        });

        $this->app->singleton(CategoryInterface::class, function() {
            $eloquentRepository = new CategoryRepository(new Category());
            $cachingRepository = new CachingCategoryRepository($eloquentRepository, $this->app['cache.store']);

            return $cachingRepository;
        });

        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(CommentInterface::class, CommentRepository::class);
    }
}
