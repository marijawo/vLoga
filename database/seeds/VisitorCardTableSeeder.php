<?php

use Illuminate\Database\Seeder;

class VisitorCardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visitor_cards')->insert(array(
            array('name' => '001'),
            array('name' => '002'),
            array('name' => '003'),
            array('name' => '004'),
            array('name' => '005'),
            array('name' => '006'),
            array('name' => '007'),
            array('name' => '008'),
            array('name' => '009'),
            array('name' => '010'),
        ));
    }
}
