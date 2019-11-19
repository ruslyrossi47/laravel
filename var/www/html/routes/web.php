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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(array('middleware' => ['auth', 'admin']), function ()
{
	// Dashboard
	Route::get('/home', 'HomeController@index')->name('home');

	// Users
	Route::get('admin/user', 'UserController@index');
	Route::get('admin/user/create', 'UserController@form');
	Route::post('admin/user/create', 'UserController@create');
	Route::get('admin/user/update/{id}', 'UserController@form');
	Route::post('admin/user/update/{id}', 'UserController@update');
	Route::get('admin/user/delete/{id}', 'UserController@delete');

	// Listing
	Route::get('admin/listing', 'ListingController@index');
	Route::get('admin/listing/create', 'ListingController@form');
	Route::post('admin/listing/create', 'ListingController@create');
	Route::get('admin/listing/update/{id}', 'ListingController@form');
	Route::post('admin/listing/update/{id}', 'ListingController@update');
	Route::get('admin/listing/delete/{id}', 'ListingController@delete');
});
