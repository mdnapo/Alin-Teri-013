<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;

class ContactEmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_email')->insert([
            'email' => 'testmail34125@gmail.com'
        ]);
    }
}
