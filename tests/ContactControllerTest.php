<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactController extends TestCase
{
    /**
     * Valid e-mail.
     *
     * @return void
     */
    public function testSuccessfulQuestion()
    {
        $this->visit('/contact')
            ->type('asdasd@asdas.de', 'email')
            ->type('Dit is mijn vraag', 'vraag')
            ->press('Versturen')
            ->seeInDatabase('contacts', ['email' => 'asdasd@asdas.de', 'bericht' => 'Dit is mijn vraag']);
    }

    /**
     * Fail to enter a basic e-mail.
     *
     * @return void
     */
    public function testFailedQuestion()
    {
        $this->visit('/contact')
            ->type('asdasd', 'email')
            ->type('Dit is mijn vraag', 'vraag')
            ->press('Versturen')
            ->see('The email must be a valid email address');
    }

    /**
     * Fail to enter a basic e-mail.
     *
     * @return void
     */
    public function testInputtedQuestions()
    {
        $user = App\User::find(1);
        $this->actingAs($user)
            ->visit('/admin/contact')
            ->see('asdasd@asdas.de');
    }


}
