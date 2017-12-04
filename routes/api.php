<?php

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
    Route::resource('articles', 'ArticleController', ['except' => ['create', 'edit']]);
});