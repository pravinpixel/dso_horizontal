<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            DepartmentSeeder::class,
            HouseTypeSeeder::class,
            MasterCategorySeeder::class,
            PackSizeSeeder::class,
            StatutorySeeder::class,
            StorageRoomSeeder::class,
            PictogramSeeder::class,
            TableOrderSeeder::class,
            // MaterialProductSeeder::class
        ]); 
    }
}