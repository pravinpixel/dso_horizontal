<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\MasterCategories;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "Material"],
            ['name' => "In-house Products"],
        ];
         
        MasterCategories::insert($data);
    }
}
