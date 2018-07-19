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
Route::get('shop/login','ShopController@login')->name('shop.login');

Route::post('shop/login','ShopController@check')->name('shop.login');

Route::get('shop/loginout','ShopController@loginout')->name('shop.loginout');

Route::get('shop/uppassword','ShopController@uppassword')->name('shop.uppassword');

Route::post('shop/uppassword','ShopController@savepassword')->name('shop.savepassword');

Route::get('shopshow','ShopController@shopshow')->name('shopshow');