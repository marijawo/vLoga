<?php

use Illuminate\Database\Seeder;

class NationalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->insert(array(
            array('name' => 'Gambian'),
            array('name' => 'Non-Gambian')
        ));
    }
}
