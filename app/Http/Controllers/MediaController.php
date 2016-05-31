<?php

namespace App\Http\Controllers;

use App;
use App\Publication;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\View;

class MediaController extends Controller
{
    /**
     * Takes the user to the In de media page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $publications = Publication::publications();
        return view('pages.media', ['publications' => $publications]);
    }

    /**
     * Searches for all publications containing the needle passed to the request.
     * @return string | \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Returns a View for a normal get request and a string for an Ajax get request.
     */
    public function search(Request $request){
        $needle = $request->needle;
        $publications = $needle == '' ?
            Publication::publications() :
            Publication::search($needle);

        if ($request->ajax()) {
            $view = View::make('subviews.media-search', ['publications' => $publications, 'needle' => $needle]);
            echo $view->render();
        }
        else
            return view('pages.media', ['publications' => $publications, 'needle' => $needle]);
    }
}
