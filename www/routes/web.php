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

	Route::resource('/home/products', 'AdminProductController',	['only' => ['index', 'create', 'store', 'edit']]);

});

Route::get('contact','ContactController@index')->name('contact.index');

Route::post('add_contact','ContactController@add_contact')->name('contact.add_contact');