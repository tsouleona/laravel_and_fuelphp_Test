<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


    Route::get('post', 'HomeController@index');
    Route::get('post/create', 'HomeController@create');
    Route::post('post', 'HomeController@store');
    Route::get('post/{id}', 'HomeController@show');
    Route::get('post/{id}/edit', 'HomeController@edit');
    Route::put('post/{id}', 'HomeController@update');
    Route::delete('post/{id}', 'HomeController@destroy');

