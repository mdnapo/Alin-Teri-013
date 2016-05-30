<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DonationController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCarouselPage()
    {
        $this->visit('/steun-ons-gallerij')
            ->click('Carousel')
            ->seePageIs('/steun-ons-carousel');
    }

    public function testSignupForNewsletter()
    {
        $this->visit('/steun-ons-gallerij')
            ->click("optin_knop")
            ->type('test@signup.com', 'email')
            ->click('Aanmelden')
            ->seeInDatabase('mailinglists', ['email' => 'test@signup.com']);
    }

    public function testDonate()
    {
        $this->visit('/steun-ons-gallerij')
            ->click("Steun ons!")
            ->attach('C:\Users\Doubl\Pictures\kappa.png', 'image')
            ->type('test@signup.com', 'email')
            ->type('opmerking', 'opmerking')
            ->click('Uploaden')
            ->seeInDatabase('donation', ['email' => 'test@signup.com', 'message' => 'opmerking']);
    }
}
