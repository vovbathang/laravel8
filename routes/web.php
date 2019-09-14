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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as'=>'admin.'], function (){
    Route::get('/users', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/users', 'UserController@store')->name('user.store');
    Route::get('/users/{id}', 'UserController@show')->name('user.show');
    Route::put('/users/{id}', 'UserController@update')->name('user.update');
    Route::delete('/users/{id}', 'UserController@delete')->name('user.delete');
});

Route::get('/home', 'HomeController@index');
