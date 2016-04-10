<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 14-3-2016
 * Time: 11:48
 */

namespace app\Http\Controllers\Admin;

use App;
use GuzzleHttp\Psr7\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Get Dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard() {
        return View('pages.adm.dashboard');
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
    public function createPage() {
        var_dump(Input::get('name'));
        if (!(empty(Input::get('name')) || empty(Input::get('route')))) {
            $page = new App\Page();
            $page->name = Input::get('name');
            if (!(empty(Input::get('parent')) || Input::get('parent') == NULL)) {
                $page->parent = Input::get('parent');
            }
            $page->html = '<br />';
            $page->route = Input::get('route');
            $page->active = Input::get('active');
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
    public function savePage($id = null) {
        $page = App\Page::where('id', $id)->firstOrFail();
        $page->html = Input::get('html');
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

    /**
     * Shows faq overview
     *
     * @return \Illuminate\Http\Request
     */
    public function faqs() {
        $faqs = App\Faq::all();
        return view('pages.adm.faq.faqs', ['faqs' => $faqs]);
    }

    /**
     * Shows an edit page for a single faq
     *
     * @param int $id
     * @return \Illuminate\Http\Request
     */
    public function faq($id = null) {
        $faq = App\Faq::findOrFail($id);
        return view('pages.adm.faq.faq', ['faq' => $faq]);
    }

    /**
     * Updates or creates a given faq entry
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function faqSave() {
        return redirect('/admin/faq');
    }

    /**
     * Deletes a faq entry
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function faqDestroy() {
        return redirect('/admin/faq');
    }

}