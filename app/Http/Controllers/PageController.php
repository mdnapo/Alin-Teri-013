<?php
/**
 * User: jjvij
 * Date: 14-3-2016
 * Time: 19:32
 */

namespace App\Http\Controllers;

use App;

class PageController extends Controller
{
    private $template = 'layouts.master';

    public function getPage($slug = null){
        $page = App\Page::where('route', $slug)->where('active', 1);
        if(empty($page->first())){
            abort(404);
        }
        return view($this->template)->with('content', $page->first());
    }
}