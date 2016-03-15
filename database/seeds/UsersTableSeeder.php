<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Jeroen Vijgen',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 1
        ]);
    }
}
