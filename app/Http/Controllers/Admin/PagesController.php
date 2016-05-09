<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:21
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PagesController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Get Page Generator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pages() {
        return View('pages.adm.pages');
    }

    /**
     * Make new Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makePage() {
        return View('pages.adm.makePage');
    }

    /**
     * Handle page creation
     * @param Request $request
     */
    public function createPage(Request $request) {
        var_dump($request->name);
        if (!(empty($request->name) || empty($request->route))) {
            $page = new App\Page();
            $page->name = $request->name;
            if (!(empty($request->parent) || $request->parent == NULL)) {
                $page->parent = $request->parent;
            }
            $page->html = '<br />';
            $page->route = $request->route;
            $page->active = $request->active;
            $page->save();
        }
        return back();
    }

    /**
     * Handle Page Editing
     * @param null $id
     */
    public function editPage($id = null) {
        return View('pages.adm.editPage', ['id' => $id]);
    }

    /**
     * Saves changes made to Dynamic Paging
     */
    public function savePage($id = null, Request $request) {
        $page = App\Page::where('id', $id)->firstOrFail();
        $page->html = $request->html;
        $page->save();
        return back();
    }

    /**
     * Deletes a page.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletePage($id = null) {
        $page = App\Page::where('id', $id)->firstOrFail();
        if (empty($id)) {
            return redirect('/admin/pages');
        } else {
            $page->delete();
            return redirect('/admin/pages');
        }
    }

    /**
     * Sets visibility for a pageroute
     * @param int $id
     * @param int $visibility
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setVisibility($id = null, $visibility = 1) {
        $page = App\Page::where('id', $id)->firstOrFail();
        if ($visibility == 0) {
            $page->active = 0;
            $page->save();
            return redirect('/admin/pages');
        } else {
            $page->active = 1;
            $page->save();
            return redirect('/admin/pages');
        }
    }

    public function movePageUp($id) {
        $page = App\Page::where('id', $id)->firstOrFail();
        if ($page->sort > 0) {
            $pageGoingDown = App\Page::where('sort', $page->sort - 1)->firstOrFail();
            $sort = $page->sort;
            $pageGoingDown->sort = App\Page::orderBy('sort', 'DESC')->first()->sort + 1;
            $page->sort = $page->sort - 1;
            $pageGoingDown->save();
            $page->save();
            $pageGoingDown->sort = $sort;
            $pageGoingDown->save();
        }
        return redirect('/admin/pages');
    }

    public function movePageDown($id) {
        $page = App\Page::where('id', $id)->firstOrFail();
        if ($page->sort < App\Page::orderBy('sort', 'DESC')->first()->sort) {
            $pageGoingUp = App\Page::where('sort', $page->sort + 1)->firstOrFail();
            $sort = $page->sort;
            $pageGoingUp->sort = App\Page::orderBy('sort', 'DESC')->first()->sort + 1;
            $page->sort = $page->sort + 1;
            $pageGoingUp->save();
            $page->save();
            $pageGoingUp->sort = $sort;
            $pageGoingUp->save();
        }
        return redirect('/admin/pages');
    }
}