<?php

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidatesRequests;
use Intervention\Image\ImageManager;

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

Route::get('donaties', 'DonationController@index');
Route::post('donaties', 'DonationController@upload');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
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