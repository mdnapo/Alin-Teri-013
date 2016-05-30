<?php
namespace App\Http\Controllers;

use App\Donation;
use App\Mailinglist;
use App\SettingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use necrox87\NudityDetector\NudityDetector;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::approvedDonations();
        return view('pages.donaties-slider', ['donations' => $donations]);
    }

    public function gallery()
    {
        $donations = Donation::paginatedDonations();
        $settings = SettingCategory::find('2')->settings;
        return view('pages.donaties-gallery', ['donations' => $donations, 'settings' => $settings]);
    }

    public function optin(Request $request)
    {
        $mailinglist = new Mailinglist();
        $mailinglist->email = strtolower($request->email);
        $mailinglist->save();
        return back();
    }

    public function upload(Request $request)
    {
        if ($request->file('image')->isValid()) {
            $rules = array(
                'image' => 'required|image',
                'email' => 'required|email',
                'opmerking' => 'string'
            );
            $validator = Validator::make($request->all(), $rules);

            if (!$validator->fails()) {
                $detector = new NudityDetector($request->image);
                $img = \Image::Make($request->image);
                $img->rotate($request->rotation);
                $img->crop($request->width, $request->height, $request->x, $request->y);
                $img->resize(400, 400);
                $donation = new Donation;
                $donation->email = $request->email;
                $donation->message = $request->opmerking;
                if ($detector->isPorn()) {
                    $donation->nsfw = 1;
                }
                $donation->save();
                $img->save('img/donaties/' . $donation->id . '.png');
                $donation->pic_loc = 'img/donaties/' . $donation->id . '.png';
                $donation->save();

                if (isset($_POST['mailinglistcb'])) {
                    $mailinglist = new Mailinglist();
                    $mailinglist->email = $request->email;
                    $mailinglist->save();
                }
            }
        }
        return back();
    }
}

?>
