<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
    protected $fillable = ['pic_loc', 'email', 'message', 'approved'];

    private $id;
    private $pic_loc;
    private $email;
    private $message;
    private $approved;

    /**
     * Get id of single donation
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get picture location
     * @return string
     */
    public function getPicLoc()
    {
        return $this->pic_loc;
    }

    /**
     * Sets the picture location
     * @param $location
     * @return void
     */
    public function setPicLoc($location){
        $this->pic_loc = $location;
    }

    /**
     * Return E-Mail of donation.
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets E-Mail.
     * @param $email
     * @return void
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * Get donation message.
     * @return longText
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets message.
     * @param $message
     * @return void
     */
    public function setMessage($message){
        $this->message = $message;
    }

    /**
     * Returns approved.
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Sets approved
     * @param $approved
     */
    public function setApproved($approved){
        if(is_numeric($approved) && ($approved == 0 || $approved == 1)){
            $this->approved = $approved;
        }else{
            $this->approved = $this->approved;
        }

    }

}
