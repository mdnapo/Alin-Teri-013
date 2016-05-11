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

    Route::post('steun-ons', 'DonationController@upload');
    Route::get('steun-ons-gallerij', 'DonationController@gallery');
    Route::get('steun-ons-carousel', 'DonationController@index');
    Route::post('newsletter/optin', 'DonationController@optin');

    Route::get('in-de-media', 'MediaController@index');
    Route::get('media-search', 'MediaController@search');


    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@insertIntoDb');

    Route::get('faq', 'FaqController@index');

    Route::get('verhalen', 'StoryController@index');

    Route::get('/p/{slug}', [
        'uses' => 'PageController@getPage'
    ])->where('slug', '([A-Za-z0-9\-\/]+)');

    Route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@dashboard');
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('pages', 'AdminController@pages');
        Route::get('steun-ons', 'AdminController@donations');
        Route::get('contact', 'AdminController@contact');
        Route::group(['prefix' => 'pages'], function () {
            Route::get('create', 'AdminController@makePage');
            Route::post('create', 'AdminController@createPage');
            Route::get('edit/{id}', ['uses' => 'AdminController@editPage'])->where('id', '([0-9])');
            Route::post('edit/{id}', ['uses' => 'AdminController@savePage'])->where('id', '([0-9])');
            Route::get('delete/{id}', ['uses' => 'AdminController@deletePage'])->where('id', '([0-9])');
            Route::get('visibility/{id}/{visibility}', ['uses' => 'AdminController@setVisibility'])->where('id', '([0-9])')->where('visibility', '([0-1])');
            Route::get('move-up/{id}', ['uses' => 'AdminController@movePageUp'])->where('id', '([0-9])');
            Route::get('move-down/{id}', ['uses' => 'AdminController@movePageDown'])->where('id', '([0-9])');
        });
        Route::group(['prefix' => 'donations'], function () {
            Route::post('accept/{id}', ['uses' => 'AdminController@acceptDonation'])->where('id', '([0-9]+)');
            Route::post('delete/{id}', ['uses' => 'AdminController@deleteDonation'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'faq'], function () {
            Route::get('/', 'AdminController@faqs');
            Route::get('/{id}', ['uses' => 'AdminController@faq'])->where('id', '[0-9]');
            Route::post('/{id}', ['uses' => 'AdminController@faqSave'])->where('id', '[0-9]');
            Route::delete('/{id}', ['uses' => 'AdminController@faqDestroy'])->where('id', '[0-9]');
        });
        Route::group(['prefix' => 'cat'], function () {
            Route::get('/{id}', ['uses' => 'AdminController@cat'])->where('id', '[0-9]');
            Route::post('/{id}', ['uses' => 'AdminController@catSave'])->where('id', '[0-9]');
            Route::delete('/{id}', ['uses' => 'AdminController@catDestroy'])->where('id', '[0-9]');
        });
        Route::group(['prefix' => 'contact'], function () {
            Route::get('view/{id}', ['uses' => 'AdminController@viewContact'])->where('id', '([0-9]+)');
            Route::post('delete/{id}', ['uses' => 'AdminController@deleteContact'])->where('id', '([0-9]+)');
            Route::post('setContactEmail', ['uses' => 'AdminController@setContactEmail']);
        });
        Route::group(['prefix' => 'media'], function () {
            Route::get('/', 'AdminController@publications');
            Route::get('/{id}', ['uses' => 'AdminController@editPublication'])->where('id', '([0-9]+)');
            Route::post('/{id}', ['uses' => 'AdminController@savePublication'])->where('id', '([0-9]+)');
            Route::post('/delete/{id}', ['uses' => 'AdminController@deletePublication'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'AdminController@settings');
            Route::post('/{id}', 'AdminController@saveSettings');
        });

        Route::get('stories', 'AdminController@stories');
        Route::group(['prefix' => 'stories'], function () {
            Route::get('create', 'AdminController@makeStory');
            Route::post('create', 'AdminController@createStory');
            Route::get('edit/{id}', ['uses' => 'AdminController@editStory'])->where('id', '([0-9])');
            Route::post('edit/{id}', ['uses' => 'AdminController@saveStory'])->where('id', '([0-9])');
            Route::get('delete/{id}', ['uses' => 'AdminController@deleteStory'])->where('id', '([0-9])');
        });
        
        Route::get('newsletter', 'AdminController@newsletter');
        Route::post('newsletter', 'AdminController@sendNewsletter');
    });
});
