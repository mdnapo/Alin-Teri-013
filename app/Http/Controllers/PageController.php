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
    private $template = 'pages.page';

    /**
     * Deletes a faq entry.
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getPage($slug = null)
    {
        $page = App\Page::where('route', $slug)->where('active', 1)->where('archived', 0)->firstOrFail();
        if (empty($page->html)) {
            abort(404);
        }
        return \View::make($this->template, array('content' => $page->html, 'id' => $page->id));
    }
}
