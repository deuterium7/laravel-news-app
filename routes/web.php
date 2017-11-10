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
    Route::get('users/{user}/ban', 'UserController@ban')->name('users.ban');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::put('users/{user}', 'UserController@admin')->name('users.admin');
    Route::get('admin/news', 'AdminController@news')->name('admin.news');
    Route::get('admin/categories', 'AdminController@categories')->name('admin.categories');
    Route::get('admin/users', 'AdminController@users')->name('admin.users');
    Route::get('admin/comments', 'AdminController@comments')->name('admin.comments');
    Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('admin.logs');
});

Route::middleware('role:user')->group(function () {
    Route::post('contact/send', 'HomeController@send')->name('home.send');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::get('articles/{article}', 'ArticleController@show')->name('articles.show');
    Route::get('comments/create', 'CommentController@create')->name('comments.create');
    Route::post('comments', 'CommentController@store')->name('comments.store');
    Route::put('comments/{comment}', 'CommentController@update')->name('comments.update');
    Route::get('comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
});

Route::get('contact', 'HomeController@contact')->name('home.contact')->middleware('auth');

Route::get('social/{provider}', 'SocialController@login');
Route::get('social/callback/{provider}', 'SocialController@callback');
Route::get('articles', 'ArticleController@index')->name('articles.index');
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/{category}', 'CategoryController@show')->name('categories.show');
Route::get('/', 'ArticleController@index');
Route::get('home', 'HomeController@index')->name('home');
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
        Session::put('locale', $locale);

        return redirect()->back();
    }
})->name('locales');
Auth::routes();
