<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\DeductTrackUsage;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function direct_deduct(Request $request)
    {
        foreach ($request->id as $key => $column) {
            $current_batch                  = Batches::find($request->id[$key]);
            $created_batch                  = $current_batch->replicate();
            $created_batch->created_at      = Carbon::now();
            $created_batch->quantity        = $request->quantity[$key];
            $created_batch->barcode_number  = generateBarcode(MaterialProducts::find($request->category_selection[$key]));
            $created_batch->remarks         = $request->remarks[$key];
            $created_batch->save();


            $old_value           = $current_batch;
            $new_value           = clone $current_batch;
            $new_value->quantity = $new_value->quantity  - $request->quantity[$key];
            LogActivity::dataLog($old_value, $new_value);

            $current_batch->update([
                'quantity' =>   $current_batch->quantity -  $request->quantity[$key]
            ]);
        }
        return redirect()->back()->with("success", "Direct Deduct Success !");
    }
    public function deduct_track_usage(Request $request)
    {
        $batch = Batches::findOrFail($request->id);
        $material = MaterialProducts::find($batch->material_product_id);
       
        DeductTrackUsage::create([
            'batch_id'         => $request->id,
            'item_description' => $material->item_description,
            'batch_serial'     => $batch->batch . ' / ' . $batch->serial,
            'last_accessed'    => auth_user()->alias_name,
            'used_amount'      => $request->used_value,
            'remain_amount'    => $batch->unit_packing_value - $request->used_value,
            'remarks'          => $request->remarks
        ]);

        $batch->update([
            "unit_packing_value" => $batch->unit_packing_value - $request->used_value
        ]);

        return redirect()->back()->with("success", "Deduct Track Usage Success !");
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
            LogActivity::dataLog($old_value, $new_value);
        }
        if($request->print_outlife_expiry == 1) {
            return redirect(route('print-barcode', RepackOutlife::find($request->id[0])->batch_id));
        }
        return redirect()->back();
    }
}