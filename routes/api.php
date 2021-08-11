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


Route::get('Users','App\Http\Controllers\UsersController@getUser');
Route::post('login','App\Http\Controllers\UsersController@Login');
Route::get('logout','App\Http\Controllers\UsersController@Logout');
Route::post('message','App\Http\Controllers\UsersController@Sendmessages');

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'LoginController@checklogininfo');
    
  
});