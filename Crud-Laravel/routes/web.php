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

Route::get('/', function () {
    return view('welcome');
});


   
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->resource('/forms','FormController');
// Route::middleware('auth')->get('/forms/create','FormController@create');
// Route::middleware('auth')->post('/forms', 'FormController@store')->name('store_forms');

// Route::get('/forms/{id}','FormController@show');
// Route::middleware('auth')->delete('/forms/{id}/delete','FormController@destroy');
Route::middleware('auth')->delete('myproductsDeleteAll', 'FormController@deleteAll');