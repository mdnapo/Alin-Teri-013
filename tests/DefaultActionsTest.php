<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class DefaultActionsTest extends TestCase {
    /**
     * Test successful login.
     *
     * @return void
     */
    public function testSuccessfulLogin() {
        $this->visit('/login')
            ->type('admin@alinteri.nl', 'email')
            ->type('admin', 'password')
            ->press('Login')
            ->seePageIs('/');
    }

    /**
     * Test failed login.
     *
     * @return void
     */
    public function testFailingLogin() {
        $this->visit('/login')
            ->type('admin@alinteri.nl', 'email')
            ->type('@dmin', 'password')
            ->press('Login')
            ->seePageIs('/login');
    }

    /**
     *  Test default pages.
     *
     * @return void
     */
    public function testDefaultPages() {
        $this->visit('/')
            ->see('Alin Teri')
            ->visit('steun-ons-gallerij')
            ->see('AlinTeri013 is een burgerinitiatief voor eerlijk verdiend brood tegen (soft)drugsgeld.')
            ->visit('contact')
            ->see('<p><b>Naam:</b> Alin Teri</p>')
            ->visit('in-de-media')
            ->see('')
            ->visit('verhalen')
            ->see('')
            ->visit('/p/Over-Ons')
            ->see('');
    }

    /**
     *  Tests the admin panel.
     *
     * @return void
     */
    public function testAdminPanel() {
        $user = User::find(1);
        $this->actingAs($user)
            ->visit('/')
            ->see('Welkom Administrator')
            ->visit('/admin/dashboard/')
            ->see('Welkom Administrator, op het AlinTeri administratiepaneel.')
            ->click('pagina\'s')
            ->see('Home')->see('Steun Ons')
            ->click('verhalen')
            ->see('verhalen')
            //->click('nieuwsbrief')
            //->see('upload een bestand en deze wordt automatisch verstuurd naar iedereen die zich heeft ingeschreven
            // voor de nieuwsbrief!')
            ->click('steun ons')
            ->see('Steun ons')
            ->click('in de media')
            ->see('Brabants Dagblad 1 mei 2016')
            ->click('contact')
            ->see('Wijzig hieronder het contact emailadres voor gestelde vragen.')
            ->click('f.a.q.')
            ->see('Algemeen')->see('Specifiek Onderwerp')
            ->click('settings')
            ->see('FAQ');
    }
}