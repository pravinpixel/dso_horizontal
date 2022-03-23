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
            ['name' => "abcd",],
            ['name' => "abcd",],
            ['name' => "abcd",],
        ];
  
        StatutoryBody::insert($data); 
    }
}
