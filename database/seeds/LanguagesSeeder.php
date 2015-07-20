<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'Lithuanian',
            'prefix' => 'LT',
            'visible' => 1,
        ]);
        DB::table('languages')->insert([
            'name' => 'English',
            'prefix' => 'EN',
            'visible' => 1,
        ]);
        DB::table('languages')->insert([
            'name' => 'Russian',
            'prefix' => 'RU',
            'visible' => 1,
        ]);
    }
}
