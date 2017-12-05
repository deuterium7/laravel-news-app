<?php

Route::group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);
    Route::resource('articles', 'ArticleController', ['except' => ['create', 'edit']]);

    Route::get('/comments/{id}/{from}', 'CommentController@comments');

    Route::get('/users/{user}', 'UserController@show');
    Route::get('/auth', 'UserController@auth');
});