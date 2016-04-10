<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class FAQController extends Controller
{
    function index() {
        $faqs = App\Question::where('faq', true)->get();
        return view('pages.faq', ['faqs'=>$faqs]);
    }
}
