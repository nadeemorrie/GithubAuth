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

Route::get('auth/github/login', 'Auth\AuthController@redirectToProvider');
// Authorization callback URL
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});
