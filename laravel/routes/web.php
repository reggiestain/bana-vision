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

Route::get('/verify-user/{code}', 'App\Http\Controllers\Auth\RegisterController@activateUser')->name('activate.user');

Route::get('/{any}', 'App\Http\Controllers\HomeController@index')->where('any', '^(?!api).*$')->name('all');
Auth::routes();
