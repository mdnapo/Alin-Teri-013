<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoryControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoryItem()
    {
        $this->visit('/')
            ->click('Verhalen')
            ->type('Fatma', 'needle')
            ->see('Fatma:');
    }
}
