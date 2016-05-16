<?php

use Illuminate\Database\Seeder;

class MailingListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,40) as $index) {
            App\Mailinglist::create([
                'email' => strtolower($faker->email)
            ]);
        }
    }
}
