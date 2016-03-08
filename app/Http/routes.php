<?php

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidatesRequests;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('donaties', function () {
	$donations = File::files('img\donaties');
	return view('donaties', compact('donations'));
});

Route::post('donaties', function(){
	if(Input::file('image')->isValid()){
		$rules = array(
			'image' => 'required|image',
			'email' => 'email',
			'opmerking' => 'string'
		);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails()){
			
		} else{
			Input::file('image')->move('img\donaties', count(File::files('img\donaties')) . '.png');
		}
	}
	return back();
});

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
    //
});
