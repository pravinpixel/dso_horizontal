<?php
namespace App\Repositories;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\BarCodeGenOne;
use App\Models\Batches;
use App\Models\MaterialProducts;

class BarCodeLabelRepository implements BarCodeLabelRepositoryInterface {
    public function generateBarcode($material_product, $batch)
    { 
        $material_product_id    =   $material_product->id;
        $batch_id               =   $batch->id;
        $category               =   $material_product->category_selection == "in_house" ? 2 : 1;
        $description            =   $material_product->item_description;
        $brand                  =   $batch->brand;
         
        $BarCodeGenOne   =  BarCodeGenOne::where("category_selection",$category)
                                            ->where("description" , $description)
                                            ->where("brand" , $brand)
                                            ->get();
        
        if(count($BarCodeGenOne) === 0) {
            $lastValue      =   BarCodeGenOne::get();
            if($lastValue->count() !== 0) {
                $firstGenCount  =   ($lastValue->last()->self_gen_one +   1);
                $ZeroNumbers    =   '';
                for($x  =   0;  $x  <   4   -   (strlen($firstGenCount));  $x++){
                    $ZeroNumbers .= "0";
                }
                $self_gen_one =  $ZeroNumbers.$firstGenCount;
            }

            if(count($BarCodeGenOne) != 0) {
                $genCount = $BarCodeGenOne->last()->self_gen_one;
            }
            $batch->BarCodeGenOne()->updateOrCreate(["batch_id" => $batch_id],[
                'category_selection' => $category,
                'description'        => $description,
                'brand'              => $brand,
                'self_gen_one'       => $genCount ?? $lastValue->count() === 0 ? "0001" : $self_gen_one
            ]);
        } else {
            $lastValue      =   BarCodeGenOne::get();
            $firstGenCount  =   ($lastValue->last()->self_gen_one +   1);
            $ZeroNumbers    =   '';

            for($x  =   0;  $x  <   4   -   (strlen($firstGenCount));  $x++){
                $ZeroNumbers .= "0";
            }
            $self_gen_one =  $ZeroNumbers.$firstGenCount;

            if($batch_id != null) {
                $genCount = $BarCodeGenOne->last()->self_gen_one;
            }
            
            $batch->BarCodeGenOne()->updateOrCreate(["batch_id" => $batch_id],[
                'category_selection' => $category,
                'description'        => $description,
                'brand'              => $brand,
                'self_gen_one'       => $batch_id != null ? $genCount : $self_gen_one
            ]);
        }
    }
}