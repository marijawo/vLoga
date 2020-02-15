<?php

use Illuminate\Database\Seeder;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert(array(
           array('name' => 'GNPC', 'description' => 'Gambia National Petroleum Corporation', 'logo', 'logo.png'),
           array('name' => 'MoPE', 'description' => 'Gambia National Petroleum Corporation', 'logo', 'logo.png'),
        ));
    }
}
/*
array('name' => 'GNPC', 'description' => 'Gambia National Petroleum Corporation', 'logo' => 'logo.png'),
            array('name' => 'MoPE', 'description' => 'Ministry of Petroleum and Energy', 'logo' => 'logo.png'),
            array('name' => 'OIC', 'description' => 'Organisation of Islamic Conference', 'logo' => 'logo.png'),
            array('name' => 'FAR', 'description' => 'FAR limited', 'logo' => 'logo.png'),*/
