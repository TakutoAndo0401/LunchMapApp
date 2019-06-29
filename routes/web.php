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


Route::get('/shops', 'ShopController@index')->name('shop.list');
Route::get('/shop/new', 'ShopController@create')->name('shop.new');
Route::post('/shop', 'ShopController@store')->name('shop.store');
Route::get('/shop/edit/{id}', 'ShopController@edit')->name('shop.edit');
Route::patch('/shop/update/{id}', 'ShopController@update')->name('shop.update');


Route::get('/shop/{id}', 'ShopController@show')->name('shop.detail');
Route::delete('/shop/{id}' , 'ShopController@destroy')->name('shop.destroy');


Route::get('/', function () {
    return redirect('/shops');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
