<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\MaterialProducts;
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

            $current_batch->update([
                'quantity' =>   $current_batch->quantity -  $request->quantity[$key]
            ]);
        } 
        return redirect()->back()->with("success","Direct Deduct Success !");
    }
    public function deduct_track_usage(Request $request)
    {
        $batch              = Batches::findOrFail($request->id);
        $material_product   = MaterialProducts::findOrFail($batch->material_product_id);

        $material_product->update([
            "unit_packing_value"    =>  $material_product->unit_packing_value - $request->used_value
        ]);
        return redirect()->back()->with("success","Deduct Track Usage Success !");
    }
}