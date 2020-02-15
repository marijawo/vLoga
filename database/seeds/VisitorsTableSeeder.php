<?php

use Illuminate\Database\Seeder;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visitors')->insert(
            array('first_name' => 'Abdallah',
                'middle_name' => 'AB',
                'last_name' => 'JALLOW',
                'gender' => 'Male',
                'phone' => 212121,
                'nationality_id' => 1 ,
                'document_type_id' => 1,
                'employee_id' => 349,
                'purpose' => 'Official',
                'visitor_card_id' => 1,
                'time_in' => '23:21',
                'time_out' => '12:21'
        ));
    }
}
