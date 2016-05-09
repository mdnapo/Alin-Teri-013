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
    Route::get('steun-ons-gallery', 'DonationController@gallery');
    Route::get('steun-ons-carousel', 'DonationController@index');
    Route::post('newsletter/optin', 'DonationController@optin');

    Route::get('in-de-media', 'MediaController@index');

    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@insertIntoDb');
    
    Route::get('faq', 'FaqController@index');

    Route::get('/p/{slug}', [
        'uses' => 'PageController@getPage'
    ])->where('slug', '([A-Za-z0-9\-\/]+)');

    Route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
        Route::get('/', 'AdminController@dashboard');
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('pages', 'PagesController@pages');
        Route::get('steun-ons', 'DonationsController@donations');
        Route::get('contact', 'ContactsController@contact');
        Route::group(['prefix' => 'pages'], function(){
            Route::get('create', 'PagesController@makePage');
            Route::post('create', 'PagesController@createPage');
            Route::get('edit/{id}', ['uses' => 'PagesController@editPage'])->where('id', '([0-9]+)');
            Route::post('edit/{id}', ['uses' => 'PagesController@savePage'])->where('id', '([0-9]+)');
            Route::get('delete/{id}', ['uses' => 'PagesController@deletePage'])->where('id', '([0-9]+)');
            Route::get('visibility/{id}/{visibility}', ['uses' => 'PagesController@setVisibility'])->where('id', '([0-9])')->where('visibility', '([0-1])');
            Route::get('move-up/{id}', ['uses' => 'PagesController@movePageUp'])->where('id', '([0-9]+)');
            Route::get('move-down/{id}', ['uses' => 'PagesController@movePageDown'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'donations'], function(){
            Route::post('accept/{id}', ['uses' => 'DonationsController@acceptDonation'])->where('id', '([0-9]+)');
            Route::post('delete/{id}', ['uses' => 'DonationsController@deleteDonation'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'faq'], function() {
            Route::get('/', 'FaqsController@faqs');
            Route::get('/{id}', ['uses' => 'FaqsController@faq'])->where('id', '([0-9]+)');
            Route::post('/{id}', ['uses' => 'FaqsController@faqSave'])->where('id', '([0-9]+)');
            Route::delete('/{id}', ['uses' => 'FaqsController@faqDestroy'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'cat'], function() {
            Route::get('/{id}', ['uses' => 'CategoryController@cat'])->where('id', '([0-9]+)');
            Route::post('/{id}', ['uses' => 'CategoryController@catSave'])->where('id', '([0-9]+)');
            Route::delete('/{id}', ['uses' => 'CategoryController@catDestroy'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'contact'], function(){
            Route::get('view/{id}', ['uses' => 'ContactsController@viewContact'])->where('id', '([0-9]+)');
            Route::post('delete/{id}', ['uses' => 'ContactsController@deleteContact'])->where('id', '([0-9]+)');
            Route::post('setContactEmail', ['uses' => 'ContactsController@setContactEmail']);
        });
        Route::group(['prefix' => 'media'], function(){
            Route::get('/', 'MediaController@publications');
            Route::get('/{id}', ['uses' => 'MediaController@editPublication'])->where('id', '([0-9]+)');
            Route::post('/{id}', ['uses' => 'MediaController@savePublication'])->where('id', '([0-9]+)');
            Route::post('/delete/{id}', ['uses' => 'MediaController@deletePublication'])->where('id', '([0-9]+)');
        });
        Route::group(['prefix' => 'settings'], function() {
            Route::get('/', 'SettingsController@settings');
            Route::post('/{id}', 'SettingsController@saveSettings');
        });
        Route::get('newsletter', 'NewsletterController@newsletter');
        Route::post('newsletter', 'NewsletterController@sendNewsletter');
    });
});
