<?php

use \Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/***
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
***/
Route::namespace('Api')->prefix('v1')->middleware(['api','cors'])->group(function (){
    Route::get('/token', 'TestController@token');
    Route::get('/login', 'TestController@login');
    //food
    Route::get('/', 'FoodController@index');
    Route::get('/food/category', 'FoodController@category');
    Route::get('/food/detail', 'FoodController@detail');
    //用户信息
    Route::get('/member', 'MemberController@index');
    Route::post('/member/share', 'MemberController@share');
    Route::post('/member/login', 'MemberController@memberLogin');
    Route::post('/member/checkReg', 'MemberController@memberCheckReg');
    Route::any('/my/order', 'MemberController@orderList');

    //cart
    Route::get('/cart', 'CartController@index');
    Route::post('/cart/cart_add', 'CartController@cart_add');
    Route::post('/cart/set', 'CartController@cart_set');
    Route::post('/cart/del', 'CartController@cart_del');
    //order
    Route::post('/order/info', 'OrderController@info');
    Route::post('/order/createOrder', 'OrderController@createOrder');
    Route::post('/order/pay', 'OrderController@orderPay');
    Route::any('/order/callback', 'OrderController@orderCallback');
    //upload
    Route::post('/upload/file', 'UploadFileController@uploadFile');
});
