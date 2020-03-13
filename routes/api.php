<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// 图片验证码
Route::get('/tag/list','TagController@index');
Route::post('/tag','TagController@store');
Route::put('/tag/{id}','TagController@update');
Route::delete('/tag/{id}','TagController@destroy');
Route::get('/tag/{id}','TagController@show');
