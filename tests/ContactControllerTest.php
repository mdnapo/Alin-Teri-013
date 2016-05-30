<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessfulQuestion()
    {
        $this->visit()
             ->type('asdasd@asdas.de', 'email')
             ->type('Dit is mijn vraag', 'vraag')
             ->click('versturen');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailedQuestion()
    {
        $this->visit()
            ->type('asdasd', 'email')
            ->type('Dit is mijn vraag', 'vraag')
            ->click('versturen');
    }

}
