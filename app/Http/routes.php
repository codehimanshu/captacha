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

Route::get('/', 'HomeController@index');

Route::auth();

Route::get('login', 'Auth\AuthController@redirectToProvider');
Route::get('register', 'Auth\AuthController@redirectToProvider');
Route::get('callback/google', 'Auth\AuthController@handleProviderCallback');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('generate/{hash}', 'HomeController@generate');
