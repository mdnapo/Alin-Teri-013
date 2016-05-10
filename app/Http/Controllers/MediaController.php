<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index(){
        $publications = Publication::paginatePublications();
        return view('pages.media', ['publications' => $publications]);
    }
}
