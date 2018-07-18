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
    return view('welcome');
});
Route::get('shop/reg','ShopController@index')->name('shop.reg');
Route::post('shop/reg','ShopController@store')->name('shop.reg');
Route::get('shop','ShopController@home')->name('shop.home');