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

Route::get('/', 'FrontendController@index');
Route::get('/patient/{id}', 'FrontendController@patient');
Route::get('/patient/get/records', function() {
    abort(404, 'Page not found');
});

// Maybe set records to route through a login page should enough time remain
Route::post('/patient/get/records/', 'FrontendController@getRecords');