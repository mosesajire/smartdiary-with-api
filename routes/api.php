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

Route::post('login', 'Api\UserController@login');

Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {

	Route::get('user', 'UserController@details');
	Route::resource('entries', 'EntryController');
	
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
