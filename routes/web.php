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
Route::middleware('app')->group(function () {
    Route::get('/', 'Bill\BoardController@board')->name('root');
    Route::get('/home', 'Bill\BoardController@board')->name('home');
    Route::prefix('meter')->group(function() {
        Route::prefix('crud')->group(function() {
            Route::post('/period', 'Meter\CrudController@period')->name('meter.crud.period');
            Route::post('/name', 'Meter\CrudController@name')->name('meter.crud.name');
            Route::post('/rate', 'Meter\CrudController@rate')->name('meter.crud.rate');
            Route::post('/type', 'Meter\CrudController@type')->name('meter.crud.type');
        });
    });

    Auth::routes([/*'register'=>false, *//*'reset' => false/**/]);
});
