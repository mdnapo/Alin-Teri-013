<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:35
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class SettingsController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Shows all settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings() {
        $cats = App\SettingCategory::all();
        return view('pages.adm.settings', compact('cats'));
    }

    /**
     * Saves the settings for the given category
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSettings($id = null, Request $request) {
        $settings = App\SettingCategory::findOrFail($id)->settings;
        $rules = array();
        foreach ($settings as $setting) {
            array_push($rules, ['set' . $setting->id => 'string|required']);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/admin/settings')
                ->withErrors($validator)
                ->withInput();
        } else {
            foreach ($settings as $setting) {
                $setting->value = $request->input('set' . $setting->id);
                $setting->save();
            }
        }

        return redirect('/admin/settings');
    }

}