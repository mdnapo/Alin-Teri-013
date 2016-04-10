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
            'question' => 'Dit is een vraag?',
            'answer' => 'Hier heb je een antwoord',
            'category_id' => 1,
        ]);

        App\Faq::create([
            'question' => 'Dit is een andere vraag?',
            'answer' => 'Hier heb je een ander antwoord',
            'category_id' => 1,
        ]);

        App\Faq::create([
            'question' => 'Dit is nog een vraag?',
            'answer' => 'Hier heb je nog een antwoord',
            'category_id' => 1,
        ]);

        App\Faq::create([
            'question' => 'Dit is geen vaak gestelde vraag?',
            'answer' => 'Hier heb je hem dan niet vaak beantwoord',
            'category_id' => 2,
        ]);
    }
}
