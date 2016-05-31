<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Illuminate\Support\Facades\View;

class StoryController extends Controller
{
    /**
     * Show the homepage.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::stories();
        return view('pages.storypage', ['stories' => $stories]);
    }

    /**
     * Searches for all stories containing the needle passed to the request.
     * @return string | \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Returns a View for a normal get request and a string for an Ajax get request.
     */
    public function search(Request $request)
    {
        $needle = $request->needle;
        $stories = $needle == '' ?
            Story::stories() :
            Story::search($needle);

        if ($request->ajax()) {
            $view = View::make('subviews.story-search', ['stories' => $stories, 'needle' => $needle]);
            echo $view->render();
        } else {
            return view('pages.stories', ['stories' => $stories, 'needle' => $needle]);
        }
    }
}
