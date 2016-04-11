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

    Route::get('steun-ons', 'DonationController@index');
    Route::post('steun-ons', 'DonationController@upload');
    Route::post('newsletter/optin', 'DonationController@optin');

    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@insertIntoDb');
    
    Route::get('faq', 'FaqController@index');

    Route::get('/p/{slug}', [
        'uses' => 'PageController@getPage'
    ])->where('slug', '([A-Za-z0-9\-\/]+)');

    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
        Route::get('/', 'AdminController@dashboard');
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('pages', 'AdminController@pages');
        Route::group(['prefix' => 'pages'], function(){
            Route::get('create', 'AdminController@makePage');
            Route::post('create', 'AdminController@createPage');
            Route::get('edit/{id}', ['uses' => 'AdminController@editPage'])->where('id', '([0-9])');
            Route::post('edit/{id}', ['uses' => 'AdminController@savePage'])->where('id', '([0-9])');
            Route::get('delete/{id}', ['uses' => 'AdminController@deletePage'])->where('id', '([0-9])');
            Route::get('visibility/{id}/{visibility}', ['uses' => 'AdminController@setVisibility'])->where('id', '([0-9])')->where('visibility', '([0-1])');
        });
        Route::group(['prefix' => 'faq'], function() {
            Route::get('/', 'AdminController@faqs');
            Route::get('/{id}', ['uses' => 'AdminController@faq'])->where('id', '[0-9]');
            Route::post('/{id}', ['uses' => 'AdminController@faqSave'])->where('id', '[0-9]');
            Route::delete('/{id}', ['uses' => 'AdminController@faqDestroy'])->where('id', '[0-9]');
        });
        Route::group(['prefix' => 'cat'], function() {
            Route::get('/{id}', ['uses' => 'AdminController@cat'])->where('id', '[0-9]');
            Route::post('/{id}', ['uses' => 'AdminController@catSave'])->where('id', '[0-9]');
            Route::delete('/{id}', ['uses' => 'AdminController@catDestroy'])->where('id', '[0-9]');
        });
        Route::get('newsletter', 'AdminController@newsletter');
        Route::post('newsletter', 'AdminController@sendNewsletter');
    });
});
