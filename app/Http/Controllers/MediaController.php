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
        foreach($publications as $publication) {
            $teaser = $publication->article;
            $teaser = strip_tags($teaser);
//            if(strlen($teaser) > 10)
//                $teaser = substr($teaser, 0, strpos($teaser, ' ', 500));
            $teaser = implode(' ', array_slice(explode(' ', $teaser), 0, 130));
            $teasers["$publication->id"] = $teaser;
        }
        return view('pages.media_v2', ['publications' => $publications, 'teasers' => $teasers]);
    }

    /**
     * Takes the user to the full publication.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        $publications = Publication::where('id', $id);
        return view('pages.media', ['publications' => $publications]);
    }

    /**
     * Searches for all publications containing the needle passed to the request.
     * @return string | \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Returns a View for a normal get request and a string for an Ajax get request.
     */
    public function search(Request $request)
    {
        $needle = $request->needle;
        $publications = $needle == '' ?
            Publication::publications() :
            Publication::search($needle);

        if ($request->ajax()) {
            $view = View::make('subviews.media-search', ['publications' => $publications, 'needle' => $needle]);
            echo $view->render();
        } else {
            return view('pages.media', ['publications' => $publications, 'needle' => $needle]);
        }
    }
}
