<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;

class FaqController extends Controller
{

    /**
     * Show the main faq overview
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $cats = App\Category::all();
        $settings = App\SettingCategory::find('1')->settings;
        return view('pages.faq', compact(
            'cats',
            'settings'
        ));
    }
}
