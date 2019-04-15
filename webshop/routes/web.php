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
Auth::routes();
Route::get('/', 'ProductsController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/categories', 'CategoriesController@index');
Route::get('/orders', 'OrdersController@index');
Route::get('/clients/edit', 'ClientsController@edit');
Route::get('/clients/edit-billing-address', 'ClientsController@editBillingAddress')->name('clients.editBillingAddress');
Route::put('/clients/{id}/updateBillingAddress', 'ClientsController@updateBillingAddress')->name('clients.updateBillingAddress');
Route::get('/clients/edit-shipping-address', 'ClientsController@editShippingAddress')->name('clients.editShippingAddress');
Route::put('/clients/{id}/updateShippingAddress', 'ClientsController@updateShippingAddress')->name('clients.updateShippingAddress');
Route::get('/shopping-cart', 'CartController@getCart')->name('product.shoppingCart');
Route::get('/add-to-cart/{id}', 'CartController@addToCart')->name('product.addToCart');
Route::get('/remove-one-from-cart/{id}', 'CartController@removeOneCartItem')->name('product.removeOneCartItem');
Route::get('/remove-all-from-cart/{id}', 'CartController@removeCartItems')->name('product.removeCartItems');
Route::resource('products', 'ProductsController');
Route::resource('categories', 'CategoriesController');
Route::resource('orders', 'OrdersController');
Route::resource('clients', 'ClientsController');
Route::get('users/{user}', 'UsersController@edit')->name('users.edit');
Route::patch('users/{user}/update', 'UsersController@update')->name('users.update');