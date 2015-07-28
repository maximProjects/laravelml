<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'maxim',
            'email' => 'maxim@gmail.com',
            'country_id' => '1',
            'password' => bcrypt('maxim'),
        ]);
    }
}
