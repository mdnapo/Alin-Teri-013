<?php
/**
 * User: jjvij
 * Date: 29-2-2016
 * Time: 10:51
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function run()
    {
        return view('pages.login');
    }

    public function Login(Request $request)
    {
        if(Auth::attempt(['Username' => $request['username'], 'password' => $request['password']], $request['remember'])){
            return redirect()->intended('admin');
        }
    }
}