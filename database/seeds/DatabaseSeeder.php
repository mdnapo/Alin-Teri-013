<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return voids
     */
    public function run() {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(ContactEmailTableSeeder::class);
        $this->call(SettingCategoriesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(SettingValuesTableSeeder::class);
        $this->call(PublicationsTableSeeder::class);
        $this->call(MailingListsTableSeeder::class);
        $this->call(StoriesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
