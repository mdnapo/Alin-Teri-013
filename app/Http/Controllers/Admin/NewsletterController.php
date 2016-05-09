<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:46
 */

namespace app\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class NewsletterController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Get Newsletter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsletter() {
        return View('pages.adm.newsletter');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendNewsletter(Request $request) {
        if (!empty(App\Mailinglist::all())) {
            if ($request->file('newsletter')->isValid()) {
                $rules = array(
                    'newsletter' => 'required',
                    'subject' => 'string|required'
                );
                $validator = Validator::make($request->all(), $rules);
                if (!$validator->fails()) {
                    $request->file('newsletter')->move("newsletter/", $request->file('newsletter')->getClientOriginalName());
                    Mail::raw('', function ($message) use ($request) {
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
}