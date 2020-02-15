<?php

use Illuminate\Database\Seeder;

class DocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert(array(
            array('name' => 'National ID'),
            array('name' => 'Driving License'),
            array('name' => 'Passport'),
            array('name' => 'Voting Card')
        ));
    }
}
