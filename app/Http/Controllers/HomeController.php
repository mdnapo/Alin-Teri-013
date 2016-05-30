<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Show the homepage.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.home');
    }
}
