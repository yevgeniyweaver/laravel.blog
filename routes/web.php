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


Route::get('/admin', 'ObjectsController@index');

Route::get('/admin/create', 'ObjectsController@create');

Route::get('/admin/edit/{id}', 'ObjectsController@edit')->where('id','[0-9]+');
Route::get('/admin/show/{id}', 'ObjectsController@show')->where('id','[0-9]+');

Route::get('/admin/show', 'ObjectsController@showAll');