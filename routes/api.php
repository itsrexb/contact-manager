<?php

use Illuminate\Http\Request;

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


Route::group(['middleware' => 'auth:api','prefix' => 'contacts', 'namespace' => 'Api'], function(){
	Route::get('list', 'ContactController@list');
	Route::get('get/{id}', 'ContactController@show');
	Route::get('request', 'ContactController@contactRequest');
	Route::get('block/{id}', 'ContactController@blockUser');
	Route::get('accept/{id}', 'ContactController@acceptUser');
	Route::get('blocked-list', 'ContactController@getBlockedList');
	Route::get('explore', 'ContactController@getAllUsers');

	Route::delete('delete/{id}', 'ContactController@destroy');

	Route::post('new', 'ContactController@storeNewContact');
	Route::post('blockedlist', 'ContactController@blockedlist');
});