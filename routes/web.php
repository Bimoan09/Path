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

Route::get('/','PathController@getPath')->name('path.get');
Route::get('/search','PathController@selectSearch')->name('path.search');
Route::post('/','PathController@storePath')->name('path.store');

// Route::get('/', function () {
//     return view('welcome');
// });
