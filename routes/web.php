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

Route::get('/', 'StartController@start')->name('start');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{slug?}', 'BreadcrumbController@category')->name('category');
// Route::get('/public/basket', 'BasketoneController@json')->name('basketone');
Route::post('/basket/order', 'BasketController@order')->name('basket.order');
Route::resource('/basket', 'BasketController');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware'=> ['auth']], function() {
  Route::resource('/category', 'CategoryController', ['as'=>'admin']);
  Route::resource('/menu', 'MenuController', ['as'=>'admin']);
});
