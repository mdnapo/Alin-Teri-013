<?php
	namespace App\Http\Controllers;

	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\Validator;

	class DonationController extends Controller {
	  public function index() {
		$donations = \File::files('img\donaties');
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
			  if($validator->fails()){

			  } else{
				  Input::file('image')->move('img\donaties', count(\File::files('img\donaties'))+1 . '.png');
			  }
		  }
		return back();
	  }
	}
?>
