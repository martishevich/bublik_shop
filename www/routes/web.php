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

Route::get('/about', 'AboutController@about');

Auth::routes();

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function (){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::match(['get', 'post'], '/home/products', 'AdminProductController@index');

	Route::post('/home/products/create', 'AdminProductController@save');

	Route::get('/home/products/create', 'AdminProductController@create');

    Route::get('/home/products/edit/{id}', 'AdminProductController@edit');

    Route::post('/home/products/edit/{id}', 'AdminProductController@save');

	Route::get('/home/products/delete/{id}', 'AdminProductController@destroy');

    Route::match(['get', 'post'], '/home/orders', 'AdminOrderController@index');

    Route::match(['get', 'post'], '/home/orders/{id}', 'AdminOrderController@show');

    Route::get('home/orders/{id}/change', 'AdminOrderController@change');
    
    Route::get('home/orders/{id}/sendmail', 'AdminOrderController@sendOrderList');

});

Route::get('contact','ContactController@index')->name('contact.index');

Route::post('add_contact','ContactController@add_contact')->name('contact.add_contact');

Route::match(['get', 'post'], '/', ['uses' => 'PostsController@index', 'as' => '/']);

Route::match(['get', 'post'], 'Cardshop', 'OrderCreateController@cardshop');

Route::match(['get','post'],'/show','AddToOrderController@add');

Route::post('orderList','AddToOrderController@viewOrder');

Route::match(['get','post'],'categories/{id}','CategoriesController@ShowCategories');

Route::match(['get', 'post'], '/product_details/{id}', 'ProductDetailsController@productdetails');
