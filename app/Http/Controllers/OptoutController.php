<?php
    namespace App\Http\Controllers;

    use App\Mailinglist;
    use DB;
    use Illuminate\Http\Request;

    class OptoutController extends Controller {

        /**
         * Takes the user to the optout page.
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index() {
            return view('pages.optout');
        }

        /**
         * Processes the optout request.
         * @return \Illuminate\Http\RedirectResponse
         */
        public function optout(Request $request){
            DB::table('mailinglists')->where('email', '=', $request->email)->delete();
            return back();
        }
    }
?>
