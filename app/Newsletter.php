<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    //
    protected $fillable = ['email'];
    //
    private $id;
    //
    private $email;
    /**
     * Return Newsletter ID
     * @return int
     */
    public function getId(){
        return $this->id;
    }
    /**
     * Get E-Mail address
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }
    /**
     * Set e-mail address
     * @return void
     */
    public function setEmail($email){
        $this->email = $email;
    }
}
