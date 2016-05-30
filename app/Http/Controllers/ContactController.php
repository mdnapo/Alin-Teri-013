<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Inserts question into DB and sends e-mail.
     * @param $request \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertIntoDb(Request $request)
    {
        //Validate form
        $rules = array(
            'email' => 'email|required',
            'vraag' => 'string|required'
        );
        $messages = array(
            'required' => 'Het veld :attribute is verplicht!'
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        //If form is valid insert question in database and send email
        if (!$validator->fails()) {
            $content = $request->vraag;
            $sender = $request->email;
            $to = App\ContactEmail::find(1)->email;
            $contact = new App\Contact;
            $contact->email = $sender;
            $contact->bericht = $content;
            $contact->save();
            Mail::send('emails.contact', ['content' => $content], function ($message) use ($sender, $to) {
                $message->subject('Vraag');
                $message->from('42in07sol@gmail.com');
                $message->to($to);
                $message->replyTo($sender);
            });
        }
        return back()->
        withErrors($validator->errors())->
        withInput();
    }
}
