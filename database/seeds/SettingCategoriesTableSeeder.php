<?php

use Illuminate\Database\Seeder;

class SettingCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\SettingCategory::create([
            'name' => 'FAQ',
        ]);
    }
}
