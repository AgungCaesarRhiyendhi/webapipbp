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

//Route Kos
Route::get('kos', 'Api\KosController@index');
Route::get('kos/{id}', 'Api\KosController@show');    
Route::post('kos', 'Api\KosController@store');
Route::put('kos/{id}', 'Api\KosController@update');
Route::delete('kos/{id}', 'Api\KosController@destroy');


//Route Transaksi
Route::get('transaksi', 'Api\TransaksiController@index');
Route::get('transaksi/{id}', 'Api\TransaksiController@show');
Route::post('transaksi', 'Api\TransaksiController@store');
Route::put('transaksi/{id}', 'Api\TransaksiController@update');
Route::delete('transaksi/{id}', 'Api\TransaksiController@destroy');