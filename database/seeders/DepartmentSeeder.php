<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\Departments;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "EGP1"],
            ['name' => "EGP4"],
            ['name' => "EGP7"],
            ['name' => "FSML"],
            ['name' => "STML"],
        ]; 
        Departments::insert($data); 
    }
}
