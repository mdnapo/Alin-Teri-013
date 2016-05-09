<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:25
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class FaqsController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Shows faq overview
     *
     * @return \Illuminate\Http\Request
     */
    public function faqs() {
        $cats = App\Category::all();
        return view('pages.adm.faq.faqs', ['cats' => $cats]);
    }

    /**
     * Shows an edit page for a single faq
     *
     * @param int $id
     * @return \Illuminate\Http\Request
     */
    public function faq($id = null) {
        if ($id == 0) {
            $faq = new App\Faq(['question' => 'Nieuwe vraag']);
        } else {
            $faq = App\Faq::findOrFail($id);
        }
        $cats = App\Category::all();
        return view('pages.adm.faq.faq', ['faq' => $faq, 'cats' => $cats]);
    }

    /**
     * Updates or creates a given faq entry
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function faqSave($id = null, Request $request) {
        if ($id == 0) {
            $faq = new App\Faq();
        } else {
            $faq = App\Faq::findOrFail($id);
        }

        $validator = Validator::make($request->all(), [
            'cat' => 'required|integer',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/faq/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->category_id = $request->cat;
            $faq->save();
        }

        return redirect('/admin/faq');
    }

    /**
     * Deletes a faq entry
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function faqDestroy($id = null) {
        $faq = App\Faq::findOrFail($id);
        $faq->delete();
        return redirect('/admin/faq');
    }

}