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

Route::get('/', function () {
    return view('shops.index');
});

Auth::routes();

Route::get('/shopping-cart/delete/{id}', 'ArticleController@deleteItemFromShoppingCart');
Route::get('/shopping-cart/remove-one/{id}', 'ArticleController@removeOneFromShoppingCart');
Route::get('/shopping-cart/add-one/{id}', 'ArticleController@addOneToShoppingCart');
Route::get('/articles/cat/{id}', 'ArticleController@articlesByCat');
Route::get('/add-to-cart/{id}', 'ArticleController@addOneToShoppingCart');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('articles', 'ArticleController');
Route::get('/shopping-cart', 'ArticleController@getCart');


