<?php

Route::resource('users', 'UsersController');
Route::get( '/', function () {
	return view( 'welcome');
} );
Auth::routes();

Route::get('/dashboard', 'HomeController@index');