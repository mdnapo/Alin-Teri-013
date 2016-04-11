<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 14-3-2016
 * Time: 11:48
 */

namespace app\Http\Controllers\Admin;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Routing\Controller;
use App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Get Dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(){
        return View('pages.adm.dashboard');
    }

    /**
     * Get Page Generator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pages(){
        return View('pages.adm.pages');
    }

    /**
     * Get Newsletter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsletter(){
        return View('pages.adm.newsletter');
    }

    /**
     * Make new Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makePage(){
        return View('pages.adm.makePage');
    }

    /**
     * Handle page creation
     * @param Request $request
     */
    public function createPage(){
        var_dump(Input::get('name'));
        if(!(empty(Input::get('name')) || empty(Input::get('route')))){
            $page = new App\Page();
            $page->name = Input::get('name');
            if(!(empty(Input::get('parent')) || Input::get('parent') == NULL)){
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
    public function editPage($id = null){
        return View('pages.adm.editPage', ['id' => $id]);
    }

    /**
     * Saves changes made to Dynamic Paging
     */
    public function savePage($id = null){
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
    public function deletePage($id = null){
        $page = App\Page::where('id', $id)->firstOrFail();
        if(empty($id)){
            return redirect('/admin/pages');
        }else{
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
    public function setVisibility($id = null, $visibility = 1){
        $page = App\Page::where('id', $id)->firstOrFail();
        if($visibility == 0){
            $page->active = 0;
            $page->save();
            return redirect('/admin/pages');
        }else{
            $page->active = 1;
            $page->save();
            return redirect('/admin/pages');
        }
    }

    public function sendNewsletter(){
        if(!empty(App\Mailinglist::all())){
            if(Input::file('newsletter')->isValid()){
                $rules = array(
                    'newsletter' => 'required',
                    'subject' => 'string|required'
                );
                $validator = Validator::make(Input::all(), $rules);
                if(!$validator->fails()){
                    Input::file('newsletter')->move("newsletter/", Input::file('newsletter')->getClientOriginalName());
                    Mail::raw('', function ($message) {
                        $message->subject(Input::get('subject'));
                        $message->attach("newsletter/" . Input::file('newsletter')->getClientOriginalName());
                        $message->from('testmail34125@gmail.com');
                        foreach(App\Mailinglist::all() as $mail){
                            $message->bcc($mail->email);
                        }
                    });
                }
            }
        }

        return back();
    }
    
}