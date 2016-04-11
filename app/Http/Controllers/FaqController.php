<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;

class FaqController extends Controller {

    /**
     * Show the main faq overview
     *
     * @return \Illuminate\Http\Response
     */
    function index() {
        $cats = App\Category::all();
        return view('pages.faq', ['cats' => $cats]);
    }
}
