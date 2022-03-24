<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\PackingSizeData;

class PackSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "kg"],
            ['name' => "L"],
            ['name' => "m"],
            ['name' => "m²"],
            ['name' => "piece"],
            ['name' => "roll"],
            ['name' => "drum"],
            ['name' => "lnyard"],
        ]; 
        
        PackingSizeData::insert($data);
    }
}
