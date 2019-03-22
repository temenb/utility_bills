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

Route::get('/', 'Bill\BoardController@board')->name('root');
Route::get('/home', 'Bill\BoardController@board')->name('home');
Route::get('/add-meter', 'Bill\BoardController@createForm')->name('data.add');
Route::put('/put-organization', 'Bill\OrganizationController@put')->name('organization.put');
Route::put('/put-service', 'Bill\ServiceController@put')->name('service.put');
Route::put('/put-meter', 'Bill\MeterController@put')->name('meter.put');
Route::put('/put-meter-value', 'Bill\MeterValueController@put')->name('meter-value.put');
Route::put('/put-service-value', 'Bill\ServiceValueController@put')->name('service-value.put');

Auth::routes([/*'register'=>false, */'reset' => false]);
