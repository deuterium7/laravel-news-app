<?php

Route::group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::resource('articles', 'ArticleController', ['except' => ['create', 'edit']]);
    Route::get('/admin/articles', 'ArticleController@articlesAdmin');

    Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);

    Route::resource('comments', 'CommentController', ['except' => ['index', 'create', 'edit']]);
    Route::get('/comments/{comment}/{from}', 'CommentController@commentsClient');
    Route::get('/admin/comments', 'CommentController@commentsAdmin');

    Route::get('/users/{user}', 'UserController@show');
    Route::get('/auth', 'UserController@auth');
    Route::get('/admin/users', 'UserController@usersAdmin');
});