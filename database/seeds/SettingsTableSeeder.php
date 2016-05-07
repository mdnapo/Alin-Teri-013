<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([
            'name' => 'Rijen - PC',
            'value' => '3',
            'possible_values' => '2,3,4',
            'setting_category_id' => 1,
            'setting_type_id' => 1,
        ]);
        App\Setting::create([
            'name' => 'Rijen - Tablet',
            'value' => '2',
            'possible_values' => '2,3',
            'setting_category_id' => 1,
            'setting_type_id' => 1,
        ]);
        App\Setting::create([
            'name' => 'Rijen - Telefoon',
            'value' => '1',
            'possible_values' => '1,2',
            'setting_category_id' => 1,
            'setting_type_id' => 1,
        ]);
    }
}
