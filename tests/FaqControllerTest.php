<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestFaqController extends TestCase
{

    /**
     * Open the page (do not use the search bar) and see if a FAQ item from default data appears
     *
     * @return void
     */
    public function testNoSearch() {
        $this->visit('/')
            ->click('FAQ')
            ->see('Dit is een veel gestelde vraag?');
    }

    /**
     * Open the page, search for a FAQ item that should exist, see if it appears
     *
     * @return void
     */
    public function testSearchExisting()
    {
        $this->visit('/')
             ->click('FAQ')
             ->type('gestelde vraag', 'search')
             ->see('Dit is een veel gestelde vraag?');
    }

    /**
     * Open the page, run a search that should get no results with default data, see if nothing from default data appears
     *
     * @return void
     */
    public function testSearchNotExisting()
    {
        $this->visit('/')
            ->click('FAQ')
            ->type('Lorem ipsum dolor sit amet', 'search')
            ->dontSee('Dit is een veel gestelde vraag?');
    }


}
