<?php

use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Faq::create([
            'question' => 'Dit is een veel gestelde vraag?',
            'answer' => 'Hier heb je dan een antwoord daarop.',
            'category_id' => 1,
        ]);

        App\Faq::create([
            'question' => 'Dit is een andere vraag?',
            'answer' => 'Hier heb je een ander antwoord.',
            'category_id' => 1,
        ]);

        App\Faq::create([
            'question' => 'Dit is nog een vraag?',
            'answer' => 'Hier heb je nog een antwoord hierop!',
            'category_id' => 1,
        ]);

        App\Faq::create([
            'question' => 'Dit is vraag voor een specifiek onderwerp?',
            'answer' => 'Hier dus een heel specifiek antwoord, die wat langer is dan sommige andere antwoorden.',
            'category_id' => 2,
        ]);
    }
}
