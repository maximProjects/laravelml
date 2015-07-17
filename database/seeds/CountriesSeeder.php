<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'name' => 'Lithuania',
        ]);
        DB::table('countries')->insert([
            'name' => 'Russia',
        ]);
        DB::table('countries')->insert([
            'name' => 'USA',
        ]);
    }
}
