<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'monitor'], function () {
    Route::get('/er','monitorController@er')->name('monitor.er');
    Route::get('/opd','monitorController@opd')->name('monitor.opd');
    Route::get('/pcu','monitorController@pcu')->name('monitor.pcu');
    Route::get('/c19','monitorController@c19')->name('monitor.c19');
});

Route::group(['prefix' => 'caller'], function () {
    Route::get('/opd','callerController@opd')->name('caller.opd');
    Route::get('/c19','callerController@c19')->name('caller.c19');
});
