<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Question::create([
           'question'=>'Dit is een vraag?',
            'answer'=>'Hier heb je een antwoord',
            'faq'=>true,
        ]);

        App\Question::create([
            'question'=>'Dit is een andere vraag?',
            'answer'=>'Hier heb je een ander antwoord',
            'faq'=>true,
        ]);

        App\Question::create([
            'question'=>'Dit is nog een vraag?',
            'answer'=>'Hier heb je nog een antwoord',
            'faq'=>true,
        ]);

        App\Question::create([
            'question'=>'Dit is geen vaak gestelde vraag?',
            'answer'=>'Hier heb je hem dan niet vaak beantwoord',
        ]);
    }
}
