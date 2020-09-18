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

    ################# BEGIN ALL ROUTES WITH AUTH ############################################################
    Route::group(['namespace'=>'Dashboard','middleware'=> 'auth:admin','prefix'=>'admin'],function (){
        Route::get('/','DashboardController@index')->name('admin.dashboard');

        ################## SETTINGS
        Route::group(['prefix'=>'settings'], function (){
           Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shippings.methods');
           Route::put('shipping-methods/{type}','SettingsController@updateShippingMethods')->name('update.shippings.methods');
        });

        ################## Profiles
        Route::group(['prefix'=>'profile'], function (){
            Route::get('edit','ProfileController@editProfile')->name('edit.profile');
            Route::put('update','ProfileController@updateProfile')->name('update.profile');
         });

        ############################################## Begin Categories ###########################################
        ############################### Begin Main Categories ##################################################
        Route::group(['prefix'=>'main_categories'],function (){
            Route::get('/','MainCategoryController@index')->name('admin.maincategories');
            Route::get('create','MainCategoryController@create')->name('admin.maincategories.create');
            Route::post('store','MainCategoryController@store')->name('admin.maincategories.store');

            Route::get('edit/{id}','MainCategoryController@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}','MainCategoryController@update')->name('admin.maincategories.update');
            //Route::get('delete/{id}','MainCategoryController@destroy')->name('admin.maincategories.delete');
            Route::delete('delete/{id}','MainCategoryController@destroy')->name('admin.maincategories.delete');
         });
####################### End Main Categories ####################################################
        ############################### Begin Main Categories ##################################################
        Route::group(['prefix'=>'sub_categories'],function (){
            Route::get('/','SubCategoryController@index')->name('admin.subcategories');
            Route::get('create','SubCategoryController@create')->name('admin.subcategories.create');
            Route::post('store','SubCategoryController@store')->name('admin.subcategories.store');
            Route::get('edit/{id}','SubCategoryController@edit')->name('admin.subcategories.edit');
            Route::post('update/{id}','SubCategoryController@update')->name('admin.subcategories.update');
            //Route::get('delete/{id}','SubCategoryController@destroy')->name('admin.subcategories.delete');
            Route::delete('delete/{id}','SubCategoryController@destroy')->name('admin.subcategories.delete');
        });
####################### End Main Categories ####################################################

        ############################################## End Categories #############################################



    });
####################################### END ALL ROUTES WITH AUTH ####################################################3






    ########################### BEGIN AUTH ############################################
    Route::group(['namespace'=>'Dashboard\Auth','middleware'=>'guest:admin','prefix'=>'admin'],function(){
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@processLogin')->name('process.login');
        //Route::get('logout', 'LoginController@logout')->name('admin.logout');

    });

   Route::get('logout', 'Dashboard\Auth\LoginController@logout')->name('admin.logout');
    ########################### END AUTH ############################################


});



