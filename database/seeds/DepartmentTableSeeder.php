<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert( array(
            array('name' => 'IT Department', 'institution_id' =>1),
            array('name' => 'HR & Admin Department', 'institution_id' => 1),
            array('name' => 'Operations Department', 'institution_id' => 1),
            array('name' => 'Downstream Department', 'institution_id' => 1),
            array('name' => 'Upstream Department', 'institution_id' => 2),
            ));
    }
}
