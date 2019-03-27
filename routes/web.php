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
    Route::get('/add-data', 'Bill\BoardController@addForm')->name('board.form');
    Route::put('/add-data', 'Bill\BoardController@putForm')->name('board.put-data');

    Auth::routes([/*'register'=>false, *//*'reset' => false/**/]);
});
