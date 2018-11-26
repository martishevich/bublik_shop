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

Route::get('/about', 'AboutController@about');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::match(['get', 'post'], '/home/products', 'AdminProductController@index');

	Route::match(['get', 'post'], '/home/products/create', 'AdminProductController@create');

    Route::match(['get', 'post'], '/home/products/edit/{id}', 'AdminProductController@edit');

	Route::get('/home/products/delete/{id}', 'AdminProductController@destroy');

});