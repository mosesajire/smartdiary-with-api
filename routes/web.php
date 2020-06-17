<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// Only authenticated users can access these routes
Route::group(['middleware' => 'auth'], function() {

	// Dashboard
	Route::get('/dashboard', 'DashboardController@index');

	// Entries
	Route::resource('entries', 'EntryController');

	// Profile
	Route::get('/profiles/', 'ProfileController@index');
	Route::get('/profiles/{id}', 'ProfileController@show');
	Route::get('/profiles/{id}/edit', 'ProfileController@edit');
	Route::put('/profiles/{id}', 'ProfileController@update');

});

