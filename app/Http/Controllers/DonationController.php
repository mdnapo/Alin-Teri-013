<?php
	namespace App\Http\Controllers;

	use App\Http\Controllers\Controller;
	use App\Donation;
	use DB;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\Validator;

	class DonationController extends Controller {
	  public function index() {
		$donations = DB::table('donations')->where('approved', 1)->get();
		return view('pages.donaties-slider', ['donations' => $donations]);
	  }

	  public function upload(){
		  if(Input::file('image')->isValid()){
			  $rules = array(
				  'image' => 'required|image',
				  'email' => 'email',
				  'opmerking' => 'string'
			  );
			  $validator = Validator::make(Input::all(), $rules);
			  if(!$validator->fails()){
				  $img = \Image::Make(Input::file('image'));
				  $img->crop(Input::get('width'), Input::get('height'), Input::get('x'), Input::get('y'));
				  $img->save('img/donaties/' . (count(\File::files('img\donaties'))+1) . '.png');
				  $donation = new Donation;
				  $donation->pic_loc = 'img/donaties/' . count(\File::files('img\donaties')) . '.png';
				  $donation->email = Input::get('email');
				  $donation->message = Input::get('opmerking');
				  $donation->save();
			  }
		  }
		return back();
	  }
	}
?>
