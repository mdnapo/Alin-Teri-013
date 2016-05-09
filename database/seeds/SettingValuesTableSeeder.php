<?php

use Illuminate\Database\Seeder;

class SettingValuesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\SettingValue::create([
            'setting_id' => '1',
            'value' => '4'
        ]);
        App\SettingValue::create([
            'setting_id' => '1',
            'value' => '3'
        ]);
        App\SettingValue::create([
            'setting_id' => '2',
            'value' => '3'
        ]);
        App\SettingValue::create([
            'setting_id' => '2',
            'value' => '2'
        ]);
        App\SettingValue::create([
            'setting_id' => '3',
            'value' => '2'
        ]);
        App\SettingValue::create([
            'setting_id' => '3',
            'value' => '1'
        ]);
    }
}
