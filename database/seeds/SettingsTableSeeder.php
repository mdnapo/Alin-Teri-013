<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Setting::create([
            'name' => 'Rijen - PC',
            'value' => 4,
            'setting_category_id' => 1,
        ]);
        App\Setting::create([
            'name' => 'Rijen - Tablet',
            'value' => 3,
            'setting_category_id' => 1,
        ]);
        App\Setting::create([
            'name' => 'Rijen - Telefoon',
            'value' => 2,
            'setting_category_id' => 1,
        ]);
    }
}
