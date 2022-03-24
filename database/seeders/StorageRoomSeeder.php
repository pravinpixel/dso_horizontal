<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\StorageRoom;

class StorageRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "AR"],
            ['name' => "CW"],
            ['name' => "MA"],
            ['name' => "SP"],
            ['name' => "MR"],
            ['name' => "Polymer"],
            ['name' => "ChemShed1"],
            ['name' => "ChemShed2"],
        ]; 
        StorageRoom::insert($data);  
    }
}
