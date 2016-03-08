<?php
	namespace App\Http\Controllers;
	
	use App\Http\Controllers\Controller;
	
	class DonationController extends Controller {
	  public function index() {
		$donations = File::files(public_path() . '\img\donaties')->paginate(15);
		return view('donaties.index', ['donations' => $donations]);
	  }
	  
	  public function uploadImage(){
		return back;
	  }
	}
?>
