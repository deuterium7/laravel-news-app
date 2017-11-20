<?php

namespace App\Providers;

use App\Contracts\Article as ArticleContract;
use App\Contracts\Category as CategoryContract;
use App\Contracts\Comment as CommentContract;
use App\Contracts\User as UserContract;
use App\Models\Article;
use App\Models\Category;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
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
        $this->app->singleton(ArticleContract::class, function () {
            $modelRepository = new ArticleRepository(new Article());
            $cachingRepository = new CachingArticleRepository($modelRepository, $this->app['cache.store']);

            return $cachingRepository;
        });

        $this->app->singleton(CategoryContract::class, function () {
            $modelRepository = new CategoryRepository(new Category());
            $cachingRepository = new CachingCategoryRepository($modelRepository, $this->app['cache.store']);

            return $cachingRepository;
        });

        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(CommentContract::class, CommentRepository::class);
    }
}
