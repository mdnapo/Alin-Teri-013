<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Inserts question into DB and sends e-mail.
     */
    public function insertIntoDb(){
        //Validate form
        $rules = array(
            'email' => 'email',
            'opmerking' => 'string|required'
        );
        $validator = Validator::make(Input::all(), $rules);
        //If form is valid insert question in database and send email
        if(!$validator->fails()){
            $content = Input::get('opmerking');
            $sender = Input::get('email');
            $to = App\ContactEmail::find(1)->email;
            $contact = new App\Contact;
            $contact->email = $sender;
            $contact->bericht = $content;
            $contact->save();
            Mail::send('emails.contact', ['content' => $content], function($message) use ($sender, $to){
                $message->subject('Vraag');
                $message->from('42in07sol@gmail.com');
                $message->to($to);
                $message->replyTo($sender);
            });
        }
        return back();
    }
}
