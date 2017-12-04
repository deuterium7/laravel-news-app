<?php

Route::middleware('guest')->group(function () {
    Route::get('/login', 'AppController@login')->name('login');
    Route::get('/login/{social}', 'AuthController@socialRedirect');
    Route::get('/login/{social}/callback', 'AuthController@socialCallback');
});

Route::middleware('auth')->group(function () {
    Route::get('/', 'AppController@app');
    Route::get('/logout', 'AuthController@logout');
});