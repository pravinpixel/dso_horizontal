<?php

namespace App\Http\Controllers;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

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
    public function get_repack_outlife($id)
    {
        return Batches::with('RepackOutlife')->find($id);
    }
    public function repack_outlife (Request $request, $id)
    {
   
        if($request->repack_id) {
            RepackOutlife::find($request->repack_id)->update(["id" => $request->repack_id]);
            
            Batches::find($id)->update(['quantity' => $request->quantity - $request->Draw_input_repack_amt]);
            return response()->json([
                "status"    => true,
                "message"   => "Success !"
            ]);
        }

        RepackOutlife::create([
            'batch_id'              => $id, 
            'quantity'              => $request->quantity, 
            'draw_in_time_stamp'    => date("Y-m-d h:i:sa"),
            'draw_out_time_stamp'   => '-',
            'draw_in_last_access'   => json_encode($request->access),
            'draw_out_last_access'  => json_encode($request->access),
            'input_repack_amount'   => $request->Draw_input_repack_amt,
            'remain_amount'         => $request->quantity - $request->Draw_input_repack_amt,
            'repack_size'           => $request->Draw_repack_size,
            'qty_cut'               => $request->Draw_qty_cut,
        ]);

        Batches::find($id)->update(['quantity' => $request->quantity - $request->Draw_input_repack_amt]);

        return response()->json([
            "status"    => true,
            "message"   => "Success !"
        ]);
    }
}
