<?php

use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::group(['namespace'=>'Dashboard','middleware'=> 'auth:admin','prefix'=>'admin'],function (){
        Route::get('/','DashboardController@index')->name('admin.dashboard');

        ################## SETTINGS
        Route::group(['prefix'=>'settings'], function (){
           Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shippings.methods');
           Route::put('shipping-methods/{type}','SettingsController@updateShippingMethods')->name('update.shippings.methods');
        });


    });







    ########################### BEGIN AUTH ############################################
    Route::group(['namespace'=>'Dashboard\Auth','middleware'=>'guest:admin','prefix'=>'admin'],function(){
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@processLogin')->name('process.login');
        //Route::get('logout', 'LoginController@logout')->name('admin.logout');

    });

   Route::get('logout', 'Dashboard\Auth\LoginController@logout')->name('admin.logout');
    ########################### END AUTH ############################################


});



