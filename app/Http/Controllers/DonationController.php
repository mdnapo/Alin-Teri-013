<?php
	namespace App\Http\Controllers;

	use App\Donation;
	use App\Mailinglist;
	use DB;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;

	class DonationController extends Controller {
	   	public function index() {
	    	$donations = Donation::approvedDonations();
			return view('pages.donaties-slider', ['donations' => $donations]);
	  	}

		public function gallery(){
			$donations = Donation::paginatedDonations();
			return view('pages.donaties-gallery', ['donations' => $donations]);
		}

		public function optin(Request $request){
			$mailinglist = new Mailinglist();
			$mailinglist->email = strtolower($request->email);
			$mailinglist->save();
			return back();
		}

		public function upload(Request $request){
	 	 if($request->file('image')->isValid()){
			  $rules = array(
				  'image' => 'required|image',
				  'email' => 'required|email',
				  'opmerking' => 'string'
			  );
			  $validator = Validator::make($request->all(), $rules);

			  if(!$validator->fails()){
				  $img = \Image::Make($request->image);
				  $img->rotate($request->rotation);
				  $img->crop($request->width, $request->height, $request->x, $request->y);
				  $img->resize(400,400);
				  $donation = new Donation;
				  $donation->email = $request->email;
				  $donation->message = $request->opmerking;
				  $donation->save();
				  $img->save('img/donaties/' . $donation->id . '.png');
				  $donation->pic_loc = 'img/donaties/' . $donation->id . '.png';
				  $donation->save();

				  if (isset($_POST['mailinglistcb'])){
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
