<?php
namespace App\Repositories;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\BarcodeFormat;
 
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