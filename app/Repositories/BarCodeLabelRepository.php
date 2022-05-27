<?php
namespace App\Repositories;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\BarCodeGenOne;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Illuminate\Support\Facades\Log;

class BarCodeLabelRepository implements BarCodeLabelRepositoryInterface {
    public function generateBarcode($material_product, $batch)
    { 
        $material_product_id    =   $material_product->id;
        $batch_id               =   $batch->id;
        $category               =   $material_product->category_selection == "in_house" ? 2 : 1;
        $description            =   $material_product->item_description;
        $brand                  =   $batch->brand;
        $defaultGenValue        =   "0000";

        $BarCodeGenOne   =  BarCodeGenOne::where("category_selection",$category)
                                            ->where("description" , $description)
                                            ->where("brand" , $brand)
                                            ->get();
        if(count($BarCodeGenOne) != 0) { 
            $lastGenValue   =   $BarCodeGenOne->first()->self_gen_one;
            return $batch->BarCodeGenOne()->updateOrCreate(["batch_id" => $batch_id],[
                'category_selection' => $category,
                'description'        => $description,
                'brand'              => $brand,
                'self_gen_one'       => $lastGenValue
            ]);
        } else {

            $dbDataCount    =   BarCodeGenOne::count();
            if($dbDataCount === 0) {
                $incrementVale      =   0000;
                $firstGenCount      =   ($incrementVale + 1);
            } else {
                if($batch_id == null) {
                    $lastGen        =   BarCodeGenOne::where("category_selection",$category)->get();
                    $incrementVale  =   $lastGen->last()->self_gen_one;
                    $firstGenCount  =   ($incrementVale + 1);
                } else  {
                    $oldFirstGenCount  = BarCodeGenOne::where("batch_id",$batch_id)->first();
                  
                    if($oldFirstGenCount == null) {
                        // if($category === 1) {
                        $lastGen        =   BarCodeGenOne::where("category_selection",$category)->get();
                        if(count($lastGen) === 0 ) {
                            $incrementVale      =   0000;
                            $firstGenCount      =   ($incrementVale + 1);
                        } else {
                            $incrementVale  =   $lastGen->last()->self_gen_one;
                            $firstGenCount  =   ($incrementVale + 1);
                        } 

                    } else {
                        $firstGenCount  =   $oldFirstGenCount->self_gen_one;
                    }
                }
            }
        }

        $ZeroNumbers    =   '';
        for($x = 0; $x < 4 - (strlen($firstGenCount)); $x++){
            $ZeroNumbers .= "0";
        }

        $self_gen_one =  $ZeroNumbers.$firstGenCount; 
        $batch->BarCodeGenOne()->updateOrCreate(["batch_id" => $batch_id],[
            'category_selection' => $category,
            'description'        => $description,
            'brand'              => $brand,
            'self_gen_one'       => $self_gen_one
        ]);
    }
}