<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get('/', function () {
        return view('pages.home');
    });

    Route::get('/p/{slug}', [
        'uses' => 'PageController@getPage'
    ])->where('slug', '([A-Za-z0-9\-\/]+)');

    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('pages', 'AdminController@pages');
        Route::get('pages/edit/{id}', ['uses' => 'AdminController@editPage'])->where('id', '([0-9])');
    });
});