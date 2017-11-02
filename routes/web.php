<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('role:admin')->group(function () {
    Route::resource('articles', 'ArticleController');
    Route::resource('comments', 'CommentController');
    Route::resource('categories', 'CategoryController');
});

Route::middleware('role:user')->group(function () {
    Route::get('articles/{article}', 'ArticleController@show')->name('articles.show');
    Route::get('comments/create', 'CommentController@create')->name('comments.create');
    Route::post('comments', 'CommentController@store')->name('comments.store');
    Route::put('comments/{comment}', 'CommentController@update')->name('comments.update');
    Route::get('comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
});

Route::get('articles', 'ArticleController@index')->name('articles.index');
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/{category}', 'CategoryController@show')->name('categories.show');
Route::get('/', 'ArticleController@index');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();