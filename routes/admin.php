<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes for all admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//NOT THAT THE PREFIX IS /admin for all amdin

Route::group(['namespace'=>'Dashboard','middleware'=> 'auth:admin'],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
});

########################### BEGIN AUTH ############################################
Route::group(['namespace'=>'Dashboard\Auth','middleware'=>'guest:admin'],function(){
    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@processLogin')->name('process.login');
});
########################### END AUTH ############################################



