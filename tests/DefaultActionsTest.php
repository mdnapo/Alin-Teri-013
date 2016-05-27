<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DefaultActionsTest extends TestCase
{
    /**
     * Test successful login.
     *
     * @return void
     */
    public function testSuccessfulLogin(){
        $this->visit('/login')
            ->type('admin@alinteri.nl', 'username')
            ->type('admin', 'password')
            ->press('login')
            ->seePageIs('/');
    }

    /**
     * Test failed login.
     *
     * @return void
     */
    public function testFailingLogin(){
        $this->visit('/login')
            ->type('admin@alinteri.nl', 'username')
            ->type('@dmin', 'password')
            ->press('login')
            ->seePageIs('/login');
    }

    /**
     *  Test default pages.
     *
     * @return void
     */
    public function testDefaultPages(){
        $this->visit('/')
            ->see('Alin Teri')
            ->visit('steun-ons-gallerij')
            ->see('AlinTeri013 is een burgerinitiatief voor eerlijk verdiend brood tegen (soft)drugsgeld. Onze
                        vrijwilligerswerk groep is open voor iedereen die zich herkent in onze boodschap. Één van onze
                        doelen
￼
 is het krijgen van 5000 profielfoto’s als steunbetuiging. Onze vrijwilligers en
                        ambassadeurs zijn het gezicht van onze publiekscampagne. Steun ons en upload je foto!')
            ->visit('contact')
            ->see('<p><b>Naam:</b> Alin Teri</p>
                    <p><b>Telefoonnummer:</b> +316123456</p>
                    <p><b>Email adres:</b> AlinTeri@Voorbeeld.nl</p>
                    <p><b>Locatie:</b> Voorbeeldstraat 1</p>')
            ->visit('in-de-media')
            ->see('')
            ->visit('verhalen')
            ->see('')
            ->visit('Over-Ons')
            ->see('');
    }


}
