<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(ContactEmailTableSeeder::class);
    }
}
