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
Route::group(['middleware' => ['app']], function () {
    Route::get('/', 'Bill\BoardController@board')->name('root');
    Route::get('/home', 'Bill\BoardController@board')->name('home');
    Route::get('/add-meter', 'Bill\BoardController@addForm')->name('data.add');
    Route::put('/add-meter', 'Bill\BoardController@putForm')->name('meter.put-extended');

    Auth::routes([/*'register'=>false, *//*'reset' => false/**/]);
});
