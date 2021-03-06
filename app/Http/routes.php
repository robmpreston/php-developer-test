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

Route::group(['middleware' => ['web', 'auth']], function() {

    Route::get('/api/people', 'PeopleController@all');
    Route::get('/api/people/{id}', 'PeopleController@get');
    Route::get('/api/people/tree/{id}', 'PeopleController@getTree');
    Route::post('/api/people/add', 'PeopleController@add');
    Route::get('/api/people/remove/{id}', 'PeopleController@remove');
    Route::post('/api/people/update/{id}', 'PeopleController@update');
    Route::get('/api/logout', 'Auth\AuthController@logout');
});

Route::group(['middleware' => 'web'], function() {
    Route::auth();

    Route::get('/api/context', 'ContextController@get');
    Route::post('/api/login', 'Auth\AuthController@ajaxLogin');
    Route::post('/api/register', 'Auth\AuthController@ajaxRegister');

    Route::get('/{vue_capture?}', function () {
        return view('index');
    })->where('vue_capture', '[\/\w\.-]*');
});
