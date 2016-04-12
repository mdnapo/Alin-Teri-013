<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = ['id'];

    /**
     * Returns non-checked photo's.
     * @return array
     */
    public static function didNotCheckYet(){
        $donation = Donation::where('approved', 0)->get();
        return $donation;
    }


    /**
     * Returns checked photo's.
     * @return array
     */
    public static function approvedDonations(){
        $donation = Donation::where('approved', 1)->get();
        return $donation;
    }

    /**
     * Sets approved
     * @param $id
     * @param $approved
     */
    public static function setApproved($id, $approved){
        $picture = Donation::where('id', $id)->first();
        if(is_numeric($approved) && ($approved == 0 || $approved == 1)){
            $picture->approved = $approved;
            $picture->save();
        }
    }

}
