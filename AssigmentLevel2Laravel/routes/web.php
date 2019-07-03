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
//Route::resource('/', 'CategoryController');
Route::get('/', [
	'as' => 'index',
	'uses' => 'CategoryController@index'

]);
Route::get('/single-product-v1/{product}', 'ProductController@index');
Route::post('/single-product-v1/{product}', 'ProductController@addToCart');
Route::get('/cart', 'ProductController@show');
Route::post('/cart', 'ProductController@updateCart');
Route::get('/checkout/{check}', 'ProductController@show')->where('check','1');
Route::post('/checkout/{check}', 'ClientController@store')->where('check','1');

Route::get('/admin', [
	'as' => 'index-admin',
	'uses' => 'CategoryController@indexAdmin'

]);
Route::delete('/admin/{category}', 'CategoryController@destroy');
Route::get('/admin/edit-category', 'CategoryController@create');
Route::post('/admin/edit-category', 'CategoryController@store');
Route::get('/admin/edit-category/{category}', 'CategoryController@edit');
Route::patch('/admin/edit-category/{category}', 'CategoryController@update');

Route::get('/admin/products', 'ProductController@indexAdmin');
Route::delete('/admin/products/{product}', 'ProductController@destroy');
Route::get('/admin/edit-product', 'ProductController@create');
Route::post('/admin/edit-product', 'ProductController@store');
Route::get('/admin/edit-product/{product}', 'ProductController@edit');
Route::patch('/admin/edit-product/{product}', 'ProductController@update');

Route::get('/admin/orders', 'OrderController@index');
Route::delete('/admin/orders/{product}', 'OrderController@destroy');
Route::get('/admin/orders/{product}', 'OrderController@view');

Route::post('/{product}', 'ProductController@addToCart');
Route::get('/{category}', 'CategoryController@showCategory');
