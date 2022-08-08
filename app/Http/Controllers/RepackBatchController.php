<?php

namespace App\Http\Controllers;

use App\Exports\RepackOutlifeExport;
use App\Models\BarcodeFormat;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class RepackBatchController extends Controller
{

    public function repack(Request $request)
    {
        
        $current_batch                 = Batches::find($request->id);
        $created_batch                 = $current_batch->replicate();
        $created_batch->created_at     = Carbon::now();
        $created_batch->quantity       = $request->quantity;
        $created_batch->unit_packing_value  = $request->PackingSize;
        $created_batch->barcode_number = generateBarcode(MaterialProducts::find($request->material_product_id)->category_selection);
        $created_batch->storage_area   = $request->storage_area;
        $created_batch->housing_type   = $request->housing_type;
        $created_batch->housing        = $request->housing;
        $created_batch->owner_one      = $request->owner_one;
        $created_batch->owner_two      = $request->owner_two;
        $created_batch->save();
         
        $current_batch->update([
            'quantity'              =>   $current_batch->quantity   - $request->quantity,
            'unit_packing_value'    =>   $current_batch->unit_packing_value   - $request->PackingSize,
        ]);

        return response()->json([
            "status" => true,
            "message" => "Repack / Transfer Success !"
        ]); 
    }
    public function get_repack_outlife($id)
    {
        $Batches    =    Batches::with('RepackOutlife')->find($id);
 
        $users = [];
        if(!is_null($Batches->access)) {
            foreach(json_decode($Batches->access) as $user_id) {
                $users[] = User::find($user_id)->alias_name;
            }
            $Batches->access = json_encode($users[0]);
        } 
        return $Batches;
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

    public function store_repack_outlife(Request $request , $id)
    {
        $repack_data    =   $request->all();
        $newestRepack   =   RepackOutlife::where("batch_id", $id)->get()->last();
         
        foreach($repack_data as $key => $repack)  {
            if($repack['draw_out']['time_stamp'] == null) {
                $repack_data[$key]['draw_in']['status']  = false;
                $repack_data[$key]['draw_out']['status'] = true;
            } else {
                $repack_data[$key]['draw_out']['status'] = false; 
            }

            if(!empty($newestRepack)) {
                if($newestRepack->draw_in == 0 && $newestRepack->draw_out == 0) {
                    $stop_next_draw_in = false;
                } else {
                    $stop_next_draw_in = true;
                }
            } else {
                $stop_next_draw_in = false;
            }
            
            Batches::find($id)->update(['quantity' => $repack['balance_amount']]);
            RepackOutlife::updateOrCreate(["id" => $repack['id']],[
                'batch_id'              => $id, 
                'quantity'              => $repack['balance_amount'] ,
                'draw_in'               => $repack_data[$key]['draw_in']['status'], 
                'draw_out'              => $repack_data[$key]['draw_out']['status'], 
                'draw_in_time_stamp'    => $repack_data[$key]['draw_in']['time_stamp'],
                'draw_out_time_stamp'   => $repack_data[$key]['draw_out']['time_stamp'],
                'draw_in_last_access'   => $repack['last_access'],
                'draw_out_last_access'  => $repack['last_access'],
                'input_repack_amount'   => $repack['repack_amount'],
                'remain_amount'         => $repack['balance_amount'],
                'repack_size'           => $repack['repack_size'],
                'qty_cut'               => $repack['qty_cut'],
                'remain_days'           => $repack['remaining_days'] ?? null,
            ]);
        }
        return response()->json([
            "status"         => true,
            "new_draw_in"    => $stop_next_draw_in,
            "message"        => "Success !"
        ]);
    }

    public function export_repack_outlife($id)
    {
        $excel_file_name =  "Repack-Outlife-".date("Y-M-d  h-i-s A").".xlsx";
        return Excel::download(new RepackOutlifeExport($id), $excel_file_name);
    }
}