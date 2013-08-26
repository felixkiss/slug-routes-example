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
// If model implements SluggableInterface, it will try to match
// the value to the column specified by getSlugIdentifier()
// If model doesn't implement SluggableInterface, it will fallback
// to the default behaviour of using id.
Route::model('user', 'User');

Route::get('users', array('as' => 'users.index', 'uses' => 'UsersController@index'));
Route::get('users/{user}', array('as' => 'users.show', 'uses' => 'UsersController@show'));