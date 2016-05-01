<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 14-3-2016
 * Time: 11:48
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Contact;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Tests\A;

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

    /**
     * Get donations admin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function donations(){
        $pending_donations = App\Donation::didNotCheckYet();
        $approved_donations = App\Donation::approvedDonations();
        return View('pages.adm.donations', ['pending_donations' => $pending_donations,
            'approved_donations' => $approved_donations]);
    }

    /**
     * Delete donation
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteDonation($id){
        $donation = App\Donation::find($id);
        \File::delete($donation->pic_loc);
        $donation->delete();
        return redirect('/admin/donations');
    }

    /**
     * Accept donation
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function acceptDonation($id){
        App\Donation::setApproved($id, 1);
        return redirect('/admin/donations');
    }

    /**
     * Redirects user to the Contact adminpanel.
     */
    public function contact(){
        $items = Contact::all();
        $contact_email = App\ContactEmail::find(1);
        return view('pages.adm.contact', [ 'items' => $items, 'contact_email' => $contact_email ]);
    }

    /**
     * Redirects user to a page displaying the contact info.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function viewContact($id = null){
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('pages.adm.viewContact', [ 'contact' => $contact ]);
    }

    /**
     * Deletes a contact and redirects the user to Contact amdinpanel.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteContact($id = null){
        $contact = Contact::where('id', $id)->firstOrFail();
        $contact->delete();
        return redirect('/admin/contact');
    }

    /**
     * Sets the contact email adres in the database.
     */
    public function setContactEmail(){
        $rules = array(
            'email' => 'email|required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if(!$validator->fails()){
            $contact_email = App\ContactEmail::find(1);
            $contact_email->email = Input::get('email');
            $contact_email->save();
            return redirect('/admin/contact');
        }
    }

    /**
     * Get publications admin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publications(){
        $publications = App\Publication::all();
        return view('pages.adm.publications', ['publications' => $publications]);
    }

    /**
     * Get publications edit/create page
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPublication($id = null){
        $publication = $id == 0 ? new App\Publication() :
            App\Publication::where('id', $id)->firstOrFail();
        return view('pages.adm.publication', ['publication' => $publication]);
    }

    /**
     * Insert publication into database
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function savePublication($id = null){
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
        $validator = Validator::make(Input::all(), $rules, $messages);

        if(!$validator->fails()){
            $publication->source = Input::get('bron');
            $publication->article = Input::get('artikel');
            $publication->video = Input::get('video');
            $publication->save();
            return redirect('admin/media');
        }
        else{
            return back()->
            withErrors($validator->errors())->
            withInput();
        }
    }
}
