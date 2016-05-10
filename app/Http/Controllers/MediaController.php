<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class MediaController extends Controller
{
    public function index(){
        $publications = Publication::publications();
        return view('pages.media', ['publications' => $publications]);
    }

    public function search(Request $request){
        $needle = $request->needle;
        $publications = $needle == '' ?
            Publication::publications():
            Publication::search($needle);

        $view = View::make('subviews/media/media-publications', ['publications' => $publications, 'needle' => $needle]);
        echo $view->render();
    }
}
