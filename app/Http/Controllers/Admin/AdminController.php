<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 14-3-2016
 * Time: 11:48
 */

namespace app\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        /**
         * User/Admin Dashboard.
         */

    }

    public function pages(){

    }
}