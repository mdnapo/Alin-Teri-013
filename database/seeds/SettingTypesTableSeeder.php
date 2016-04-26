<?php

use Illuminate\Database\Seeder;

class SettingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\SettingType::create([
            'name' => 'radio',
        ]);
    }
}
