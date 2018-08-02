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

Route::get('addshop/{id}','ShopController@addshop')->name('addshop');

Route::post('addshop/{id}','ShopController@saveshop')->name('saveshop');

Route::get('login','ShopController@login')->name('login');

Route::post('shop/login','ShopController@check')->name('shop.login');

Route::get('shop/loginout','ShopController@loginout')->name('shop.loginout');

Route::get('shop','IndexController@home')->name('shop.home');

Route::get('shop/uppassword','ShopController@uppassword')->name('shop.uppassword');

Route::post('shop/uppassword','ShopController@savepassword')->name('shop.savepassword');

Route::get('shopshow','ShopController@shopshow')->name('shopshow');

Route::resource('menucategories','MenuCategoryController');

Route::get('selected/{menucategory}','MenuCategoryController@is_selected')->name('selected');

Route::resource('menus','MenuController');
//修改菜品的状态
Route::get('updateStatus/{menu}','MenuController@updateStatus')->name('updateStatus');

Route::get('activity','ActivityController@index')->name('activity.index');

Route::get('activity/{id}','ActivityController@show')->where(['id'=>'\d+'])->name('activity.show');

Route::post('uploader',function(){
      $store=\Illuminate\Support\Facades\Storage::disk('oss');
      $fileName=$store->putFile('elebran/upload',request()->file('file'));
      $fileurl=$store->url($fileName);
      return ['fileurl'=>$fileurl];
})->name('uploader');
//获取订单列表
Route::get('orderList/{shop_id}','OrderController@index')->name('orderList');
//查看订单详情
Route::get('showOrder/{order}','OrderController@showOrder')->name('showOrder');
//取消订单
Route::get('cancelOrder/{order}','OrderController@cancelOrder')->name('cancelOrder');
//发货
Route::get('ship/{order}/{code}','OrderController@Ship')->name('Ship');
//订单统计
Route::get('orderCount','OrderController@orderCount')->name('orderCount');
//每月订单统计
Route::get('orderMonth','OrderController@orderMonth')->name('orderMonth');
//每天菜品统计
Route::get('orderMenu','OrderController@orderMenu')->name('orderMenu');
//每月菜品统计
Route::get('MonthMenuOrder','OrderController@MonthMenuOrder')->name('MonthMenuOrder');
//抽奖活动列表
Route::get('events','EventController@index')->name('events.index');
//查看抽奖活动详情
Route::get('eventShow/{id}','EventController@eventShow')->name('eventShow');
//报名
Route::get('signUp/{event}','EventController@SignUp')->name('signUp');
//查看抽奖结果
Route::get('prizeResult/{event}','EventController@prizeResult')->name('prizeResult');

