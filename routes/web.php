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

Route::get('shop/reg','ShopController@index')->name('shop.reg');

Route::post('shop/reg','ShopController@store')->name('shop.reg');

Route::get('shop/edit/{shop}','ShopController@edit')->name('shop.edit');

Route::post('shop/update/{shop}','ShopController@updateshop')->name('shop.update');

Route::get('shop','IndexController@home')->name('shop.home');

Route::get('login','ShopController@login')->name('login');

Route::post('shop/login','ShopController@check')->name('shop.login');

Route::get('shop/loginout','ShopController@loginout')->name('shop.loginout');

Route::get('shop/uppassword','ShopController@uppassword')->name('shop.uppassword');

Route::post('shop/uppassword','ShopController@savepassword')->name('shop.savepassword');

Route::get('shopshow','ShopController@shopshow')->name('shopshow');

Route::resource('menucategories','MenuCategoryController');

Route::get('selected/{menucategory}','MenuCategoryController@is_selected')->name('selected');

Route::resource('menus','MenuController');

