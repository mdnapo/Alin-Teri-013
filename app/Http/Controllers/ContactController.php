<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
        echo(Input::get('email'));
        $contact = new App\Contact;
        $contact->email = Input::get('email');
        $contact->bericht = Input::get('opmerking');
        $contact->save();
        //$message = wordwrap(Input::get('opmerking'), 70, "\r\n");
        //mail("alinteri013@gmail.com", "Vraag", $message);
        return back();
    }
}
