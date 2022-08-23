<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\DeductTrackUsage;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function direct_deduct(Request $request)
    { 
        foreach ($request->id as $key => $column) {
            $current_batch = Batches::find($request->id[$key]);
            $old_value     = clone $current_batch;
            $new_value     = $current_batch; 

            $current_batch->update([
                'quantity'  =>  $current_batch->quantity -  $request->quantity[$key]
            ]);
            
            LogActivity::dataLog($old_value, $new_value,  $request->remarks[$key] ?? "");
        }
        return redirect()->back()->with("success_message", __('global.direct_deduct_success'));
    }
    public function deduct_track_usage(Request $request)
    {
        $batch      = Batches::findOrFail($request->id);
        $material   = MaterialProducts::find($batch->material_product_id);
          
        DeductTrackUsage::create([
            'batch_id'         => $request->id,
            'item_description' => $material->item_description,
            'batch_serial'     => $batch->batch . ' / ' . $batch->serial,
            'last_accessed'    => auth_user()->alias_name,
            'used_amount'      => $request->used_value,
            'remain_amount'    => ($batch->quantity * $batch->unit_packing_value) - $request->used_value,
            'remarks'          => $request->remarks
        ]);

        $remain_amount = (float) ($batch->quantity * $batch->unit_packing_value) - $request->used_value;

        $batch->update([
            "unit_packing_value" => (float) $remain_amount / $batch->unit_packing_value
        ]);
       
        $old_value     = clone $material;
        $new_value     = $material; 

        $material->update([
            "end_of_material_product" => $request->end_of_material_product == 1 ? true : false
        ]); 

        LogActivity::dataLog($old_value, $new_value,  $request->remarks ?? "");

        return redirect()->back()->with("success_message", __('global.deduct_track_usage_success'));
    }
    public function deduct_track_outlife(Request $request)
    {
        foreach ($request->id as $key => $row) {
            $repackOutlife = RepackOutlife::find($request->id[$key]);
            $old_value     = clone $repackOutlife;
            $new_value     = $repackOutlife;
            $repackOutlife->update([
                'remarks' => $request->remarks[$key],
            ]);
           
            LogActivity::dataLog($old_value, $new_value,  $request->remarks[$key] ?? "");
        }
        if($request->print_outlife_expiry == 1) {
            return redirect(route('print-barcode', RepackOutlife::find($request->id[0])->batch_id));
        }
        return redirect()->back();
    }
}