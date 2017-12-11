<?php

Route::group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::middleware('ban')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::resource('articles', 'ArticleController', ['except' => ['create', 'edit']]);
            Route::get('/admin/articles', 'ArticleController@articlesAdmin');

            Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);

            Route::resource('comments', 'CommentController', ['except' => ['index', 'create', 'edit']]);
            Route::get('/admin/comments', 'CommentController@commentsAdmin');

            Route::resource('users', 'UserController', ['except' => ['index', 'create', 'edit']]);
            Route::get('/admin/users', 'UserController@usersAdmin');
            Route::put('/users/{user}/admin', 'UserController@admin');
        });

        Route::get('/articles', 'ArticleController@index');
        Route::get('/articles/{article}', 'ArticleController@show');

        Route::get('/categories', 'CategoryController@index');
        Route::get('/categories/{category}', 'CategoryController@show');

        Route::get('/comments/{comment}/{from}', 'CommentController@commentsClient');
        Route::post('/comments', 'CommentController@store');
        Route::put('/comments/{comment}', 'CommentController@update');

        Route::get('/users/{user}', 'UserController@show');
        Route::get('/auth', 'UserController@auth');
    });
});
