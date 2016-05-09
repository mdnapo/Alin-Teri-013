<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:59
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class MediaController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Get publications admin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publications() {
        $publications = App\Publication::all();
        return view('pages.adm.publications', ['publications' => $publications]);
    }

    /**
     * Get publications edit/create page
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPublication($id = null) {
        $publication = $id == 0 ? new App\Publication() :
            App\Publication::where('id', $id)->firstOrFail();
        return view('pages.adm.publication', ['publication' => $publication]);
    }

    /**
     * Insert publication into database
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function savePublication($id = null, Request $request) {
        $publication = $id == 0 ? new App\Publication() :
            App\Publication::where('id', $id)->firstOrFail();

        $messages = array(
            'required' => 'Het veld :attribute is verplicht!'
        );

        $rules = array(
            'bron' => 'string|required',
            'artikel' => 'string|required',
            'video' => 'string'
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {
            $publication->source = $request->bron;
            $publication->article = $request->artikel;
            $publication->video = $request->video;
            $publication->save();
            return redirect('admin/media');
        } else {
            return back()->
            withErrors($validator->errors())->
            withInput();
        }
    }

    /**
     * Delete publication from database
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deletePublication($id = null) {
        $publication = App\Publication::where('id', $id)->firstOrFail();
        $publication->delete();
        return redirect('/admin/media');
    }

}