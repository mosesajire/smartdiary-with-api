<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route for user login
Route::post('login', 'Api\UserController@login');

// Route for registering new user
Route::post('register', 'Api\UserController@register');

// Access to these routes require authentication
Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {

	// Route for fetching user details
	Route::get('details', 'UserController@details');

	// Route for managing entries
	Route::resource('entries', 'EntryController');
	
});
