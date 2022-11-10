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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('/create', 'App\Http\Controllers\HomeController@store')->name('store');
Route::get('/car/{id}/models', 'App\Http\Controllers\HomeController@getModelsOfCar')->name('models');
Route::get('/prospects', 'App\Http\Controllers\HomeController@listAll')->name('list');
route::get('/user/{id}','App\Http\Controllers\HomeController@show')->name('show');
route::put('/update/{id}','App\Http\Controllers\HomeController@update')->name('update');
route::delete('/user/{id}','App\Http\Controllers\HomeController@destroy')->name('delete');
