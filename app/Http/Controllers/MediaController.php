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
        $publications = Publication::paginatePublications();
        return view('pages.media', ['publications' => $publications]);
    }

    public function search(Request $request){
        $needle = $request->needle;
        $publications = $needle == '' ?
            Publication::paginatePublications():
            Publication::where('source', 'LIKE', "%$needle%")->
        orWhere('article', 'LIKE', "%$needle%")->paginate(10);

        $view = View::make('subviews/media/media-publications', ['publications' => $publications, 'needle' => $needle]);
        echo $view->render();
    }
}
