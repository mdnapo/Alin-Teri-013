<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:37
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ContactsController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Redirects user to the Contact adminpanel.
     */
    public function contact() {
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
    public function viewContact($id = null) {
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('pages.adm.viewContact', ['contact' => $contact]);
    }

    /**
     * Deletes a contact and redirects the user to Contact amdinpanel.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteContact($id = null) {
        $contact = Contact::where('id', $id)->firstOrFail();
        $contact->delete();
        return redirect('/admin/contact');
    }

    /**
     * Sets the contact email adres in the database.
     */
    public function setContactEmail(Request $request) {
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

}