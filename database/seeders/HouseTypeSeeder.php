<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\HouseTypes;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "Flammable Cabinet"],
            ['name' => "Acid Cabinet"],
            ['name' => "Base Cabinet"],
            ['name' => "Metal Cabinet"],
            ['name' => "Racks"],
            ['name' => "Dry Cabinet"],
            ['name' => "Freezer"],
            ['name' => "Pallet"],
            ['name' => "nil"],
        ];
                
        HouseTypes::insert($data);
    }
}