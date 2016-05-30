<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class NewsletterControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSendNewsletter()
    {
        $user = User::find(1);
        $this->actingAs($user)
            ->visit('/admin/dashboard/')
            ->click('nieuwsbrief')
            ->type('Onderwerp', 'subject')
            ->attach('C:\Users\Doubl\Downloads\WEBS2_EINDOPDRACHT.pdf', 'newsletter')
            ->press('Versturen');
    }
}
