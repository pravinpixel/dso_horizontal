<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\StatutoryBody;

class StatutorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "SCDF"],
            ['name' => "NEA"],
            ['name' => "HSA"],
            ['name' => "NA(CWC)"],
            ['name' => "SPF"],
            ['name' => "Not Applicable"],
        ];
       
  
        StatutoryBody::insert($data); 
    }
}
