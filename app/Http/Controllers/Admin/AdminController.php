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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\Yaml\Tests\A;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get Dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return View('pages.adm.dashboard');
    }

    /**
     * Get Page Generator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pages()
    {
        return View('pages.adm.pages');
    }

    /**
     * Get Newsletter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsletter()
    {
        $mails = App\Mailinglist::all();
        $files = File::allFiles('newsletter');
        return view('pages.adm.newsletter', compact(
            'mails',
            'files'
        ));
    }

    /**
     * Make new Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makePage()
    {
        return View('pages.adm.makePage');
    }

    /**
     * Handle page creation
     * @param Request $request
     */
    public function createPage(Request $request)
    {
        if (!(empty($request->name) || empty($request->route))) {
            $page = new App\Page();
            $page->name = $request->name;
            if (!(empty($request->parent) || $request->parent == null)) {
                $page->parent = $request->parent;
            }
            $page->html = '<br />';
            $page->route = $request->route;
            $page->active = $request->active;
            $page->sort = DB::table('pages')->max('sort') + 1;
            $page->save();
        }
        return back();
    }

    /**
     * Handle Page Editing
     * @param null $id
     */
    public function editPage($id = null)
    {
        return View('pages.adm.editPage', ['id' => $id]);
    }

    /**
     * Saves changes made to Dynamic Paging
     */
    public function savePage($id = null, Request $request)
    {
        $page = App\Page::where('id', $id)->firstOrFail();
        if ($page->html != $request->html) {
            $archive = new App\Archive();
            $archive->page_id = $id;
            $archive->html = $page->html;
            $archive->save();
            $page->html = $request->html;
            $page->save();
        }
        return back();
    }

    /**
     * Deletes a page.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletePage($id = null)
    {
        $page = App\Page::where('id', $id)->firstOrFail();
        if (empty($id)) {
            return redirect('/admin/pages');
        } else {
            $page->archived = 1;
            $page->save();
            return redirect('/admin/pages');
        }
    }

    /**
     * Sets visibility for a pageroute
     * @param int $id
     * @param int $visibility
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setVisibility($id = null, $visibility = 1)
    {
        $page = App\Page::where('id', $id)->firstOrFail();
        $page->active = $visibility;
        $page->save();
        return redirect('/admin/pages');
    }

    public function sendNewsletter(Request $request)
    {
        if (!empty(App\Mailinglist::all())) {
            if ($request->file('newsletter')->isValid()) {
                $rules = array(
                    'newsletter' => 'required',
                    'subject' => 'string|required'
                );
                $validator = Validator::make($request->all(), $rules);
                if (!$validator->fails()) {
                    $request->file('newsletter')->move("newsletter/",
                        $request->file('newsletter')->getClientOriginalName());
                    Mail::raw('Klik hier om je uit te schrijven voor de nieuwsbrief: ' . url('/optout'),
                        function ($message) use ($request) {
                            $message->subject($request->subject);
                            $message->attach("newsletter/" . $request->file('newsletter')->getClientOriginalName());
                            $message->from('testmail34125@gmail.com');
                            foreach (App\Mailinglist::all() as $mail) {
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
    public function faqs()
    {
        $cats = App\Category::all();
        return view('pages.adm.faq.faqs', ['cats' => $cats]);
    }

    /**
     * Shows an edit page for a single faq
     *
     * @param int $id
     * @return \Illuminate\Http\Request
     */
    public function faq($id = null)
    {
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
    public function faqSave($id = null, Request $request)
    {
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
    public function faqDestroy($id = null)
    {
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
    public function cat($id = null)
    {
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
    public function catSave($id = null, Request $request)
    {
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
    public function catDestroy($id = null)
    {
        $cat = App\Category::findOrFail($id);
        $cat->delete();
        return redirect('/admin/faq');
    }

    /**
     * Get donations admin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function donations()
    {
        $pending_donations = App\Donation::didNotCheckYet();
        $approved_donations = App\Donation::approvedDonations();
        return View('pages.adm.donations', [
            'pending_donations' => $pending_donations,
            'approved_donations' => $approved_donations
        ]);
    }

    /**
     * Delete donation
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteDonation($id)
    {
        $donation = App\Donation::find($id);
        \File::delete($donation->pic_loc);
        $donation->delete();
        return redirect('/admin/steun-ons');
    }

    /**
     * Accept donation
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function acceptDonation($id)
    {
        App\Donation::setApproved($id, 1);
        return redirect('/admin/steun-ons');
    }

    /**
     * Redirects user to the Contact adminpanel.
     */
    public function contact()
    {
        $items = Contact::all();
        $contact_email = App\ContactEmail::find(1);
        if ($contact_email == null) {
            $contact_email = new App\ContactEmail();
        }
        return view('pages.adm.contact', ['items' => $items, 'contact_email' => $contact_email]);
    }

    /**
     * Redirects user to a page displaying the contact info.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function viewContact($id = null)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('pages.adm.viewContact', ['contact' => $contact]);
    }

    /**
     * Deletes a contact and redirects the user to Contact amdinpanel.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteContact($id = null)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        $contact->delete();
        return redirect('/admin/contact');
    }

    /**
     * Sets the contact email adres in the database.
     */
    public function setContactEmail(Request $request)
    {
        $rules = array(
            'email' => 'email|required'
        );
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $contact_email = App\ContactEmail::find(1);
            $contact_email->email = $request->email;
            $contact_email->save();
            return redirect('/admin/contact');
        }
    }

    /**
     * Get publications admin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publications()
    {
        $publications = App\Publication::all();
        return view('pages.adm.publications', ['publications' => $publications]);
    }

    /**
     * Get publications edit/create page
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPublication($id = null)
    {
        $publication = $id == 0 ? new App\Publication() :
            App\Publication::where('id', $id)->firstOrFail();
        return view('pages.adm.publication', ['publication' => $publication]);
    }

    /**
     * Insert publication into database
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function savePublication($id = null, Request $request)
    {
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
    public function deletePublication($id = null)
    {
        $publication = App\Publication::where('id', $id)->firstOrFail();
        $publication->delete();
        return redirect('/admin/media');
    }

    public function movePageUp($id)
    {
        $page = App\Page::where('id', $id)->firstOrFail();
        if ($page->sort > App\Page::where('archived', 0)->orderBy('sort')->first()->sort) {
            $pageGoingDownID = App\Page::where('archived', 0)->where('sort', '<', $page->sort)->max('sort');
            $pageGoingDown = App\Page::where('sort', $pageGoingDownID)->firstOrFail();
            $sort = $page->sort;
            $pageSort = $pageGoingDown->sort;
            $pageGoingDown->sort = App\Page::orderBy('sort', 'DESC')->first()->sort + 1;
            $page->sort = $pageSort;
            $pageGoingDown->save();
            $page->save();
            $pageGoingDown->sort = $sort;
            $pageGoingDown->save();
        }
        return redirect('/admin/pages');
    }

    public function movePageDown($id)
    {
        $page = App\Page::where('id', $id)->firstOrFail();
        if ($page->sort < App\Page::where('archived', 0)->orderBy('sort', 'DESC')->first()->sort) {
            $pageGoingUpID = App\Page::where('archived', 0)->where('sort', '>', $page->sort)->min('sort');
            $pageGoingUp = App\Page::where('sort', $pageGoingUpID)->firstOrFail();
            $sort = $page->sort;
            $pageSort = $pageGoingUp->sort;
            $pageGoingUp->sort = App\Page::orderBy('sort', 'DESC')->first()->sort + 1;
            $page->sort = $pageSort;
            $pageGoingUp->save();
            $page->save();
            $pageGoingUp->sort = $sort;
            $pageGoingUp->save();
        }
        return redirect('/admin/pages');
    }

    /**
     * Shows all settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $cats = App\SettingCategory::all();
        return view('pages.adm.settings', compact('cats'));
    }

    /**
     * Saves the settings for the given category
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSettings($id = null, Request $request)
    {
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

    /**
     *
     */
    public function stories()
    {
        return view('pages.adm.stories');
    }

    public function makeStory()
    {
        return View('pages.adm.makeStory');
    }

    public function createStory(Request $request)
    {
        $rules = [
            'naam' => 'required|string',
            'verhaal' => 'required|string',
        ];
        $messages = array(
            'required' => 'Het veld :attribute is verplicht!'
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {
            $story = new App\Story();
            $story->naam = $request->naam;
            $story->verhaal = $request->verhaal;
            $story->save();
            return redirect('/admin/stories');
        }
        return back()->
        withErrors($validator->errors())->
        withInput();
    }

    public function editStory($id = null)
    {
        return view('pages.adm.editStory', ['id' => $id]);
    }

    public function saveStory($id = null, Request $request)
    {
        $rules = [
            'naam' => 'required|string',
            'verhaal' => 'required|string',
        ];
        $messages = array(
            'required' => 'Het veld :attribute is verplicht!'
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->fails()) {
            $story = App\Story::where('id', $id)->firstOrFail();
            $story->naam = $request->naam;
            $story->verhaal = $request->verhaal;
            $story->save();
            return redirect('/admin/stories');
        }
        return back()->
        withErrors($validator->errors())->
        withInput();
    }

    public function deleteStory($id = null)
    {
        $story = App\Story::where('id', $id)->firstOrFail();
        if (!empty($id)) {
            $story->delete();
        }
        $stories = App\Story::all();
        $view = View::make('subviews.stories-table', ['items' => $stories]);
        echo $view->render();
    }

    /**
     * Delete comment from database
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteComment($id = null)
    {
        $comment = App\Comment::where('id', $id)->firstOrFail();
        $publication = App\Publication::where('id', $comment->publication_id)->firstOrFail();
        $comment->delete();
        $view = View::make('subviews.publication-comments', ['publication' => $publication]);
        echo $view->render();
    }

    /**
     * Accepts comment
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function acceptComment($id = null)
    {
        $comment = App\Comment::where('id', $id)->firstOrFail();
        $comment->geaccepteerd = 1;
        $comment->save();
        $publication = App\Publication::where('id', $comment->publication_id)->firstOrFail();
        $view = View::make('subviews.publication-comments', ['publication' => $publication]);
        echo $view->render();
    }

    /**
     * Shows the mailinglist.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mailinglist(Request $request)
    {
        $needle = $request->needle;
        $list = $needle == '' ? App\Mailinglist::orderBy('email', 'ASC')->paginate(10) :
            App\Mailinglist::search($needle)->orderBy('email', 'ASC')->paginate(10);
        return view('pages.adm.mailinglist', compact(
            'list',
            'needle'
        ));
    }

    /**
     * Removes a given email entry from the mailinglist.
     */
    public function deleteMailing($id)
    {
        $mailing = App\Mailinglist::findOrFail($id);
        $mailing->delete();
        return back();
    }

    /**
     * Adds entries to the mailinglist
     */
    public function saveMailing(Request $request)
    {
        $mails = str_getcsv(strtolower(str_replace(" ", "", $request->mails)));

        $messages = [
            'email' => 'Er zit een fout in een e-mail op positie :attribute'
        ];
        $validator = Validator::make($mails, ['*' => 'email'], $messages);

        if ($validator->fails()) {
            return redirect('/admin/mailinglist')
                ->withErrors($validator)
                ->withInput();
        } else {
            foreach ($mails as $mail) {
                if (!count(App\Mailinglist::where('email', $mail)->get())) {
                    App\Mailinglist::create(['email' => $mail]);
                }
            }
        }

        return back();
    }

    public function restorePage($id = null)
    {
        $page = App\Page::where('id', $id)->firstOrFail();
        $page->archived = 0;
        $page->save();
        return redirect('/admin/pages');
    }

    public function viewArchive($id = null)
    {
        $template = 'pages.adm.archivePage';
        $page = App\Page::where('id', $id)->where('archived', 1)->firstOrFail();
        if (empty($page->html)) {
            abort(404);
        }
        return \View::make($template, array('content' => $page->html, 'id' => $page->id));
    }
}
