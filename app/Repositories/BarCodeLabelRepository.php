<?php
namespace App\Repositories;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\BarcodeFormat;
use Illuminate\Support\Facades\Log;  
class BarCodeLabelRepository implements BarCodeLabelRepositoryInterface {
    public function generateBarcode($material_product, $batch)
    { 
        $barcodeTable = BarcodeFormat::get();

        // ===  Check if Table is Empty  ====
        if(count($barcodeTable) === 0) { // If Table Is Empty
            return $this->storeBarcodeFormate(
                $material_product,
                $batch, 
                "0001",
                "0001"
            );
        } else { // If Table Is Not  Empty

            // === Check IF Self Gen One is Same  ===
            $selfGenerationOne  =    BarcodeFormat::where('category_selection', $material_product->category_selection)
                                    ->where('item_description', $material_product->item_description)
                                    ->where('brand', $batch->brand)
                                    ->get();
            if($selfGenerationOne) {
                if(count($selfGenerationOne) !== 0 ) { // isset
                    $genOneCode         =   $this->generateZeros($selfGenerationOne->last()->self_gen_one);
                } else {

                    if($material_product->category_selection == "in_house") {
                        $in_house_series    =   BarcodeFormat::where('category_selection', "in_house")->get();
                        if(count($in_house_series) == 0) {
                            $isSeries = (object) [
                                "batch_id"      => 0,
                                "self_gen_one"  => "0000",
                            ];
                        } else {
                            $isSeries = $in_house_series->last();
                        }
                    }

                    if($material_product->category_selection == "material") {
                        $material_series    =   BarcodeFormat::where('category_selection', "material")->get();
                        if(count($material_series) == 0) {
                            $isSeries = (object) [
                                "batch_id"      => 0,
                                "self_gen_one"  => "0000",
                            ];
                        } else {
                            $isSeries = $material_series->last();
                        }
                    } 
                    $isIncrement        =   $batch->id != $isSeries->batch_id ? 1 : 0 ;
                    $genOneCode         =   $this->generateZeros($isSeries->self_gen_one + $isIncrement);
                }

                $info = BarcodeFormat::where([
                    'category_selection'    =>  $material_product->category_selection, 
                    'self_gen_one'          =>  $genOneCode,
                    'serial'                =>  $batch->serial,
                    'batch'                 =>  $batch->batch,
                ])->get()->last();

                if( isset( $info) && !empty($info) ) {
                    //get previous gen_two_number
                    $self_gen_two = $info->self_gen_two;
                } else {
                    $self_gen_two = '0001';
                    //getbatchone details
                    $second_info = BarcodeFormat::where([
                        'category_selection' => $material_product->category_selection, 
                        'self_gen_one'       => $genOneCode,
                    ])->get()->last();
                    if( isset( $second_info) && !empty($second_info)) {
                        $self_gen_two         =   $this->generateZeros($second_info->self_gen_two + 1);
                    }  
                }
                return $this->storeBarcodeFormate(
                    $material_product,
                    $batch,
                    $genOneCode,
                    $self_gen_two
                );
            }
        }
    }

    public function storeBarcodeFormate($material_product, $batch, $self_gen_one , $self_gen_two)
    {
        BarcodeFormat::updateOrCreate(["batch_id" => $batch->id ?? null],[
            "category_selection"    =>  $material_product->category_selection,
            "item_description"      =>  $material_product->item_description,
            "brand"                 =>  $batch->brand,
            "self_gen_one"          =>  $self_gen_one,
            "batch"                 =>  $batch->batch,
            "serial"                =>  $batch->serial,
            "self_gen_two"          =>  $self_gen_two, 
            "barcode_label"         => ($material_product->category_selection == 'material' ? "1" : "2").$self_gen_one.$self_gen_two,
        ]);
    }
    public function generateZeros($incrementValue)
    {
        $zero = '';
        for($x = 0; $x < 4 - (strlen($incrementValue)); $x++){
            $zero .= "0";
        }
        return $zero.$incrementValue;
    }
}

// $material_product_id    =   $material_product->id;
// $batch_id               =   $batch->id;
// $category               =   $material_product->category_selection == "in_house" ? 2 : 1;
// $description            =   $material_product->item_description;
// $brand                  =   $batch->brand;
// $defaultGenValue        =   "0000";

// $BarCodeGenOne   =  BarCodeGenOne::where("category_selection",$category)
//                                     ->where("description" , $description)
//                                     ->where("brand" , $brand)
//                                     ->get();
// if(count($BarCodeGenOne) != 0) {
//     $lastGenValue       =   $BarCodeGenOne->first();
//     $BarCodeGenOneData  =  $batch->BarCodeGenOne()->updateOrCreate(["batch_id" => $batch_id],[
//         'category_selection' => $category,
//         'description'        => $description,
//         'brand'              => $brand,
//         'self_gen_one'       => $lastGenValue->self_gen_one
//     ]);
    
//     $serialBarCode =  BarCodeGenTwo::where('serial', $batch->serial)
//                                     ->where('batch_id', $BarCodeGenOne
//                                     ->first()->batch_id)->get();
    
//     $BarCodeGenTwoData = $BarCodeGenOneData->BarCodeGenTwo()->updateOrCreate(["batch_id" => $batch_id],[
//         'batch_id'     =>  $batch->id,
//         'batch'        =>  $batch->batch,
//         'serial'       =>  $batch->serial,
//         'self_gen_two' =>  count($serialBarCode) == 0 ? "0002" : "0001"
//     ]);
//     return true;
// } else {
//     $dbDataCount    =   BarCodeGenOne::count();
//     if($dbDataCount === 0) {
//         $incrementVale      =   0000;
//         $firstGenCount      =   ($incrementVale + 1);
//     } else {
//         if($batch_id == null) {
//             $lastGen        =   BarCodeGenOne::where("category_selection",$category)->get();
//             $incrementVale  =   $lastGen->last()->self_gen_one;
//             $firstGenCount  =   ($incrementVale + 1);
//         } else  {
//             $oldFirstGenCount  = BarCodeGenOne::where("batch_id",$batch_id)->first();
            
//             if($oldFirstGenCount == null) {
//                 // if($category === 1) {
//                 $lastGen        =   BarCodeGenOne::where("category_selection",$category)->get();
//                 if(count($lastGen) === 0 ) {
//                     $incrementVale      =   0000;
//                     $firstGenCount      =   ($incrementVale + 1);
//                 } else {
//                     $incrementVale  =   $lastGen->last()->self_gen_one;
//                     $firstGenCount  =   ($incrementVale + 1);
//                 } 

//             } else {
//                 $firstGenCount  =   $oldFirstGenCount->self_gen_one;
//             }
//         }
//     }
// }

// $ZeroNumbers    =   '';
// for($x = 0; $x < 4 - (strlen($firstGenCount)); $x++){
//     $ZeroNumbers .= "0";
// }

// $self_gen_one =  $ZeroNumbers.$firstGenCount; 
// $BarCodeGenOneData  =  $batch->BarCodeGenOne()->updateOrCreate(["batch_id" => $batch_id],[
//     'category_selection' => $category,
//     'description'        => $description,
//     'brand'              => $brand,
//     'self_gen_one'       => $self_gen_one
// ]);

// $BarCodeGenTwoData = $BarCodeGenOneData->BarCodeGenTwo()->updateOrCreate(["batch_id" => $batch_id],[
//     'batch_id'      => $batch->id,
//     'batch'         => $batch->batch,
//     'serial'        => $batch->serial,
//     'self_gen_two'  => "0001"
// ]);