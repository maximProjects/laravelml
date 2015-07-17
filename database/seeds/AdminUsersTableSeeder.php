<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adminusers')->insert([
            'name' => 'maxim',
            'email' => 'maxim@gmail.com',
            'country_id' => '1',
            'password' => bcrypt('maxim'),
        ]);
    }
}
