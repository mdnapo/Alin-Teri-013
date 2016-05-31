<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = ['id'];

    /**
     * Returns non-checked photo's.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function didNotCheckYet()
    {
        $donation = Donation::where('approved', 0)->get();
        return $donation;
    }


    /**
     * Returns checked photo's.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function approvedDonations()
    {
        $donation = Donation::where('approved', 1)->get();
        return $donation;
    }

    /**
     * Sets approved
     * @param int $id
     * @param $approved
     */
    public static function setApproved($id, $approved)
    {
        $picture = Donation::where('id', $id)->first();
        if (is_numeric($approved) && ($approved == 0 || $approved == 1)) {
            $picture->approved = $approved;
            $picture->save();
        }
    }

    /**
     * Returns checked foto's with paginations
     * @returns \Illuminate\Database\Eloquent\Collection
     */
    public static function paginatedDonations()
    {
        $donations = Donation::where('approved', 1)->paginate(24);
        return $donations;
    }

}
