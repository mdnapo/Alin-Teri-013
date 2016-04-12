<?php
	namespace App\Http\Controllers;

	use App\Http\Controllers\Controller;
	use App\Donation;
	use App\Mailinglist;
	use DB;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\Mail;
	use Illuminate\Support\Facades\Validator;

	class DonationController extends Controller {
	  public function index() {
		$donations = Donation::approvedDonations();
		return view('pages.donaties-slider', ['donations' => $donations]);
	  }

		public function optin(){
			$mailinglist = new Mailinglist();
			$mailinglist->email = Input::get('email');
			$mailinglist->save();
			return back();
		}

	  	public function upload(){
		  if(Input::file('image')->isValid()){
			  $rules = array(
				  'image' => 'required|image',
				  'email' => 'required|email',
				  'opmerking' => 'string'
			  );
			  $validator = Validator::make(Input::all(), $rules);
			  if(!$validator->fails()){
				  $img = \Image::Make(Input::file('image'));
				  $img->rotate(Input::get('rotation'));
				  $img->crop(Input::get('width'), Input::get('height'), Input::get('x'), Input::get('y'));
				  $img->resize(400,400);
				  $donation = new Donation;
				  $donation->email = Input::get('email');
				  $donation->message = Input::get('opmerking');
				  $donation->save();
				  $img->save('img/donaties/' . $donation->id . '.png');
				  $donation->pic_loc = 'img/donaties/' . $donation->id . '.png';
				  $donation->save();

				  if (isset($_POST['mailinglistcb'])){
					  $mailinglist = new Mailinglist();
					  $mailinglist->email = Input::get('email');
					  $mailinglist->save();
				  }
			  }
		  }
		return back();
	  }
	}
?>
