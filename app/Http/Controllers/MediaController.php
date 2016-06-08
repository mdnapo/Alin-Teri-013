<?php

namespace App\Http\Controllers;

use App;
use App\Publication;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\View;
use App\Helpers\TextHelper;

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
            $teaser = TextHelper::create_teaser($publication->article);
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
        $publication = Publication::where('id', $id)->firstOrFail();
        return view('pages.media-view', ['publication' => $publication]);
    }

    /**
     * Searches for all publications containing the needle passed to the request.
     * @param \Illuminate\Http\Request $request
     * @return string | \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Returns a View for a normal get request and a string for an Ajax get request.
     */
    public function search(Request $request)
    {
        $needle = $request->needle;
        $publications = $needle == '' ?
            Publication::publications() :
            Publication::search($needle);

        $teasers = [];
        foreach($publications as $publication) {
            $teaser = TextHelper::create_teaser($publication->article);
            $teasers["$publication->id"] = $teaser;
        }

        if ($request->ajax()) {
            $view = View::make('subviews.media-search', ['publications' => $publications, 'needle' => $needle, 'teasers' => $teasers]);
            echo $view->render();
        } else {
            return view('pages.media_v2', ['publications' => $publications, 'needle' => $needle, 'teasers' => $teasers]);
        }
    }
}
