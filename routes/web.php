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
            Route::post('/update', 'Meter\CrudController@update')->name('meter.crud.update');
        });
    });
    Route::prefix('service')->group(function() {
        Route::prefix('crud')->group(function() {
            Route::post('/update', 'Service\CrudController@update')->name('service.crud.update');
        });
    });
    Route::prefix('organization')->group(function() {
        Route::prefix('crud')->group(function() {
            Route::post('/update', 'Organization\CrudController@update')->name('organization.crud.update');
        });
    });

    Auth::routes([/*'register'=>false, *//*'reset' => false/**/]);
});
