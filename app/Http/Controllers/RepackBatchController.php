<?php

namespace App\Http\Controllers;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Illuminate\Http\Request;
 

class RepackBatchController extends Controller
{
    public function __construct(BarCodeLabelRepositoryInterface $barCodeLabelRepository)
    {
        $this->barCodeLabelRepository   =   $barCodeLabelRepository;
    }

    public function repack(Request $request)
    {
        $material_product   =   MaterialProducts::find($request->material_product_id);
        $repackBatch        =   $request->all();
     
        $OldBatch           =   Batches::find($request->id);
        $repackBatchValue   =   json_decode($OldBatch->actions);
     
        if($repackBatchValue->repack_code == null) {
            $repack_code = "01";
        }elseif($repackBatchValue->repack_code == "01"){
            $repack_code = "02";
        }  elseif($repackBatchValue->repack_code == "02") {
            return response()->json([
                "status"    => false,
                "message"   => "Batch is Already Two Time  Repacked !"
            ]);
        }
       
        $OldBatch->actions =  json_encode([
            "repack_code"    =>  $repack_code,
            "packing_value"  =>  null,
            "packing_size"   =>  null,
            "remain_amount"  =>  null,
        ]);
        $OldBatch->save();

        $repackBatch["actions"] = json_encode([
            "repack_code"    =>  null,
            "packing_value"  =>  $material_product->unit_packing_value,
            "packing_size"   =>  $request->PackingSize,
            "remain_amount"  =>  $material_product->unit_packing_value - $request->PackingSize,
        ]);

        $createdBatch       =   $material_product->Batches()->create($request->all());
        $Batches            =   Batches::find($createdBatch->id);
        $this->barCodeLabelRepository->generateBarcode($material_product, $Batches);

        return response()->json([
            "status" => true,
            "message" => "Transfer Success !"
        ]);
    }
}
