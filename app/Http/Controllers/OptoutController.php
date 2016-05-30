<?php
namespace App\Http\Controllers;

use App\Mailinglist;
use DB;
use Illuminate\Http\Request;

class OptoutController extends Controller
{
    public function index()
    {
        return view('pages.optout');
    }

    public function optout(Request $request)
    {
        DB::table('mailinglists')->where('email', '=', $request->email)->delete();
        return back();
    }
}

?>