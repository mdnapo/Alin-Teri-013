<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:40
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Shows an edit page for a single faq
     *
     * @param int $id
     * @return \Illuminate\Http\Request
     */
    public function cat($id = null) {
        if ($id == 0) {
            $cat = new App\Category(['name' => 'Nieuwe categorie']);
        } else {
            $cat = App\Category::findOrFail($id);
        }
        return view('pages.adm.faq.cat', ['cat' => $cat]);
    }

    /**
     * Updates or creates a given faq entry
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function catSave($id = null, Request $request) {
        if ($id == 0) {
            $cat = new App\Category();
        } else {
            $cat = App\Category::findOrFail($id);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|String',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/cat/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $cat->name = $request->name;
            $cat->save();
            return redirect('/admin/faq');
        }
    }

    /**
     * Deletes a category entry
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function catDestroy($id = null) {
        $cat = App\Category::findOrFail($id);
        $cat->delete();
        return redirect('/admin/faq');
    }

}