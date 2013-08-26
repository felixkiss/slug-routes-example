<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

// Bind {user} to User model
Route::model('user', 'User');

Route::get('users', array('as' => 'users.index', 'uses' => 'UsersController@index'));
Route::get('users/{user}', array('as' => 'users.show', 'uses' => 'UsersController@show'));