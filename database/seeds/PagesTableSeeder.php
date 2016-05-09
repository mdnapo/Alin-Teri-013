<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        App\Page::create([
            'name' => 'Home',
            'route' => '',
            'html' => '<h1 class="entry-title">Alin Teri</h1>
<p class="entry-title"><img class="size-medium wp-image-429 alignright" style="float: right;" src="http://www.alinteri.nl/wp-content/uploads/2015/04/uitreiking-prodemosprijs-300x230.jpg" alt="uitreiking prodemosprijs" width="179" height="137" />&ldquo;H&uuml;lya Cigdem uit Tilburg heeft de ProDemosprijs 2015 gewonnen voor het project Alin Teri, een burgerinitiatief tegen de relatieve oververtegenwoordiging van Turken in de hennepteelt. Dat is bekendgemaakt tijdens de viering van het eerste lustrum van ProDemos &ndash; Huis voor democratie en rechtsstaat.</p>
<p class="entry-title">Het motto &lsquo;alin teri&rsquo; is Turks voor &lsquo;zweet op je voorhoofd&rsquo;. Niet met drugshandel, maar met hard werken dient men zijn brood te verdienen, zo luidt de boodschap. H&uuml;lya Cigdem roept mensen op de actie te steunen door een eigen profielfoto te doneren: <a href="http://www.alinteri.nl/steun-ons-2/">www.alinteri.nl/steun-ons</a></p>
<p class="entry-title" style="text-align: left;"><br /><img class="wp-image-433 size-medium alignleft" style="float: left;" src="http://www.alinteri.nl/wp-content/uploads/2015/04/Koning-Willem-Aalexander-feliciteert-Hulya-Cigdem-300x294.jpg" alt="Koning Willem-Aalexander feliciteert Hulya Cigdem" width="196" height="193" />Uit alle voordrachten voor Meester Burgers vond de jury, bestaande uit Ank Bijleveld-Schouten, Job Cohen en Art Rooijakkers, de inzet van H&uuml;lya het meest aansprekend. De jury was onder de indruk van haar actie. Ze zet zich in voor een belangrijke zaak. En het is dapper om zo openlijk voor het bestrijden van hennepteelt in de eigen omgeving uit te komen. Ze spreekt mensen aan op hun verantwoordelijkheid. Het is extra effectief dat het initiatief uit de eigen gemeenschap komt en niet vanuit de autoriteiten. Daarbij is het belangrijk dat H&uuml;lya steun krijgt van de autoriteiten&nbsp;&eacute;n van veel Tilburgers. De jury vindt dit project een mooi voorbeeld van hoe &eacute;&eacute;n persoon in staat is veel teweeg te brengen.&rdquo; bron: ProDemos</p>
<p class="entry-title" style="text-align: left;">&nbsp;</p>
<p class="entry-title">Burgerinitiatief Alinteri013 is open voor iedereen die zich uit wil spreken tegen de thuisteelt van hennep.</p>
<p class="entry-title">&nbsp;</p>
<p class="entry-title"><img class="size-medium wp-image-200 alignright" style="float: right;" src="http://www.alinteri.nl/wp-content/uploads/2015/04/logo-223x300.jpg" alt="Burgerinitiatief Alinteri013 is open voor iedereen die zich uit wil spreken tegen de thuisteelt van hennep." width="223" height="300" />De hennepteelt ondermijnt niet alleen onze rechtstaat, maar ook de Turkse waarde Alin Teri. Alleen al in Tilburg zijn 2.500 mensen werkzaam in de hennepteelt, waarin zo&rsquo;n 800 miljoen euro omgaat. De Brabantse stad kent tussen de 600 tot 900 illegale wietplantages en het is daarmee uitgegroeid tot &eacute;&eacute;n van de grootste bedrijfstakken. De hennephandel vormt een serieuze bedreiging voor de veiligheid en integriteit van de samenleving.</p>
<p class="entry-title">Wij, als groep Turkse Nederlanders uit Tilburg, zijn niet blij met de huidige stand van zaken. De relatieve oververtegenwoordiging van de Turkse Nederlanders in de hennepteelt kunnen en willen wij niet accepteren. Dat heeft er voor gezorgd dat we de publiekcampagne AlinTeri013 zijn begonnen.</p>',
            'protected' => 1,
            'sort' => 0,
        ]);

        App\Page::create([
            'name' => 'Steun ons',
            'route' => 'steun-ons-gallerij',
            'html' => '<p>
                    <strong>AlinTeri013 is een burgerinitiatief voor eerlijk verdiend brood tegen (soft)drugsgeld. Onze
                        vrijwilligerswerk groep is open voor iedereen die zich herkent in onze boodschap. Één van onze
                        doelen is het krijgen van 5000 profielfoto’s als steunbetuiging. Onze vrijwilligers en
                        ambassadeurs zijn het gezicht van onze publiekscampagne. Steun ons en upload je foto!</strong>
                </p>',
            'protected' => 1,
            'sort' => 1,
        ]);

        App\Page::create([
            'name' => 'Contact',
            'route' => 'contact',
            'html' => '<p><b>Naam:</b> Alin Teri</p>
            <p><b>Telefoonnummer:</b> +316123456</p>
            <p><b>Email adres:</b> AlinTeri@Voorbeeld.nl</p>
            <p><b>Locatie:</b> Voorbeeldstraat 1</p>',
            'protected' => 1,
            'sort' => 2,
        ]);

        \App\Page::create([
            'name' => 'In de media',
            'route' => 'in-de-media',
            'html' => '',
            'protected' => 1,
            'sort' => 3
        ]);

        App\Page::create([
            'name' => 'Over Ons',
            'route' => 'Over-Ons',
            'html' => 'Dit is een demo over ons pagina<br />',
            'sort' => 4,
        ]);

        App\Page::create([
            'name' => 'FAQ',
            'route' => 'faq',
            'html' => '',
            'sort' => 5,
            'protected' => 1,
        ]);

        App\Page::create([
            'name' => 'Demo',
            'route' => 'demopagina',
            'html' => '',
            'active' => 0,
            'sort' => 6,
        ]);
    }
}
