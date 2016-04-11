<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        App\Category::create([
            'name' => 'Algemeen',
        ]);

        App\Category::create([
            'name' => 'Specifiek Onderwerp',
        ]);

    }
}
