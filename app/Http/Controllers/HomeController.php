<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class HomeController extends Controller {
    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('home');
    }
}
