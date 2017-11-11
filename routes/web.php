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

Route::get('/', 'GitController@index'); //home page
Route::get('api/v1/get-listings', 'GitController@listing'); //api for listing


/*
Route::get('/', function () {
    return view('welcome');
});
*/