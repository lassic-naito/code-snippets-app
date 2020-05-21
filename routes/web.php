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

Route::get('/', 'PostsController@index');


//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::resource('posts', 'PostsController');

Route::group(['prefix' => 'category/{id}'], function () {
    Route::get('', 'CategoriesController@index')->name('categories.index');
});


// ユーザ機能
Route::group(['middleware' => ['auth']], function () {
    Route::resource('reviews', 'ReviewsController', ['only' => ['store']]);
    Route::resource('users', 'UsersController', ['only' => ['index']]);
    
    Route::group(['prefix' => 'users'], function () {
        Route::get('delete/{id}', 'UsersController@deleteData');
    });
    
    Route::group(['prefix' => 'posts/{id}'], function () {
        Route::post('put', 'TagCheckController@store')->name('tag.put');
        Route::delete('out', 'TagCheckController@destroy')->name('tag.out');
    });
});