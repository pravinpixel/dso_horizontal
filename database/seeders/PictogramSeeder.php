<?php

namespace Database\Seeders;

use App\Models\Pictogram;
use Illuminate\Database\Seeder;

class PictogramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         

        $data = [
           ['name' => 'Explosive', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/GHS-pictogram-explos.svg/150px-GHS-pictogram-explos.svg.png"],
           ['name' => 'Flammable', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/GHS-pictogram-flamme.svg/150px-GHS-pictogram-flamme.svg.png"],
           ['name' => 'Oxidizing', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/GHS-pictogram-rondflam.svg/150px-GHS-pictogram-rondflam.svg.png"],
           ['name' => 'Compressed Gas', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/GHS-pictogram-bottle.svg/150px-GHS-pictogram-bottle.svg.png"],
           ['name' => 'Corrosive', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/GHS-pictogram-acid.svg/150px-GHS-pictogram-acid.svg.png"],
           ['name' => 'Toxic', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/GHS-pictogram-skull.svg/150px-GHS-pictogram-skull.svg.png"],
           ['name' => 'Harmful', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/GHS-pictogram-exclam.svg/150px-GHS-pictogram-exclam.svg.png"],
           ['name' => 'Health hazard', "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/GHS-pictogram-silhouette.svg/150px-GHS-pictogram-silhouette.svg.png"],
        ];
        Pictogram::insert($data);
    }
}
