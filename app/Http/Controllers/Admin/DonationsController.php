<?php
/**
 * Created by PhpStorm.
 * User: jjvij
 * Date: 9-5-2016
 * Time: 20:22
 */

namespace app\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;


class DonationsController extends Controller
{
    /**
     * AdminController constructor.
     * Uses Auth middleware to check access.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Get donations admin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function donations() {
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
    public function deleteDonation($id) {
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
    public function acceptDonation($id) {
        App\Donation::setApproved($id, 1);
        return redirect('/admin/steun-ons');
    }

}