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
            'name' => 'Over Ons',
            'route' => 'Over-Ons',
            'html' => 'Holy shit it works!<br />'
        ]);
        App\Page::create([
            'route' => 'demopagina',
            'html' => '',
            'active' => 0
        ]);
    }
}
