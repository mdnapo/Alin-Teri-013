<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestFaqController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFaqItem()
    {
        $this->visit('/')
             ->click('FAQ')
             ->type('gestelde vraag', 'search')
             ->see('Dit is een veel gestelde vraag?');
    }

    public function testNonFaq()
    {
        $this->visit('/')
            ->click('FAQ')
            ->type('2013', 'search')
            ->see('Dit is een veel gestelde vraag?');
    }
}
