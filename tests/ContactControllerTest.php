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
     * Changes the default e-mail address.
     *
     * @return void
     */
    public function changeContactEmail()
    {
        $user = App\User::find(1);
        $this->actingAs($user)
            ->visit('/admin/contact')
            ->see('testmail34125@gmail.com')
            ->type('alinteri+website@gmail.com', 'email')
            ->press('Wijzigen')
            ->see('alinteri+website@gmail.com')
            ->type('testmail34125@gmail.com', 'email')
            ->press('Wijzigen')
            ->see('testmail34125@gmail.com');
    }

    /**
     * See if the question is in the admin panel.
     *
     * @return void
     */
    public function testInputtedQuestions()
    {
        $user = App\User::find(1);
        $this->actingAs($user)
            ->visit('/admin/contact')
            ->see('asdasd@asdas.de')
            ->see('Dit is mijn vraag');
    }
    
    /**
     *  Deletes the first asked question.
     *
     * @return void
     */
    public function deleteAskedQuestion()
    {
        $user = App\User::find(1);
        $this->actingAs($user)
            ->visit('/admin/contact')
            ->click("1")
            ->dontSee('asdasd@asdas.de');
    }

}
