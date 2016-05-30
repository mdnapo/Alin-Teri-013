<?php

use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Story::create([
            'naam' => 'Fatma: “Geen wiet, geen sterretje”',
            'verhaal' => '“Geen wiet, geen sterretje.” Ze zegt het midden in het gesprek, alsof iedereen die uitdrukking kent. In bepaalde kringen in Tilburg kennelijk wel. Het betekent: als je niet in de wiethandel zit, dan kan je ook geen Mercedes rijden. De  vrouw die met ons praat – laten we haar voor de verandering Fatma noemen – heeft wèl gekweekt, ongeveer anderhalf jaar lang.',
        ]);

        App\Story::create([
            'naam' => 'Türkay (40): “Je kunt beter eelt op je handen hebben”',
            'verhaal' => 'Tegenwoordig werkt hij met liefde en plezier in ploegendienst in de fabriek, maar in het verleden was hij zo’n 10 jaar betrokken in de Tilburgse hennepteelt. Türkay: “Ik heb er spijt van, als de grijze haren op mijn hoofd. Achteraf gezien is het de moeite niet waard geweest. Het heeft meer gekost dan me heeft opgeleverd. En veel meer dan me lief is.”',
        ]);

        App\Story::create([
            'naam' => 'Bülent: “Wiet is verdriet”',
            'verhaal' => '“Tilburg is crimineler dan Den Haag. Daar sprak niemand over wiet. Hier in Tilburg  was het normaal. In de koffiehuizen praatten ze openlijk. ‘Hoeveel heb je er af gehaald, hoeveel kilo? Hoeveel droog en hoeveel nat?’ Als je één keer naar het koffiehuis ging, wist je alles.”',
        ]);
    }
}
