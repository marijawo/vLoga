<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call([
            DocumentTypeTableSeeder::class,
            VisitorCardTableSeeder::class,
            NationalityTableSeeder::class,
//            DepartmentTableSeeder::class,
//            InstitutionTableSeeder::class,

            UserTableSeeder::class

        ]);
    }
}
