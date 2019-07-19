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
    Route::post('/member/share', 'MemberController@share');
    Route::get('/member/cart', 'MemberController@member_cart_list');
    Route::post('/member/cart_add', 'MemberController@member_cart_add');
});
