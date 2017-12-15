<?php

Route::group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::middleware('ban')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::apiResource('comments', 'CommentController', ['except' => 'index']);
            Route::apiResource('users', 'UserController', ['except' => 'index']);
            Route::apiResource('categories', 'CategoryController');
            Route::apiResource('articles', 'ArticleController');

            Route::get('/admin/articles', 'ArticleController@articlesAdmin');
            Route::get('/admin/comments', 'CommentController@commentsAdmin');
            Route::get('/admin/users', 'UserController@usersAdmin');

            Route::put('/users/{user}/admin', 'UserController@admin');
        });

        Route::get('/comments/{comment}/{from}', 'CommentController@commentsClient');
        Route::get('/categories/{category}', 'CategoryController@show');
        Route::get('/articles/{article}', 'ArticleController@show');
        Route::get('/categories', 'CategoryController@index');
        Route::get('/articles', 'ArticleController@index');
        Route::get('/favorite/articles', 'ArticleController@articlesFavorite');
        Route::get('/users/{user}', 'UserController@show');
        Route::get('/auth', 'UserController@auth');

        Route::post('/comments', 'CommentController@store');

        Route::put('/comments/{comment}', 'CommentController@update');
    });
});
