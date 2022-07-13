<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
class TransferBatchController extends Controller
{
    public function transfer(Request $request)
    {
        $current_batch                 = Batches::find($request->id);
        $created_batch                 = $current_batch->replicate();
        $created_batch->created_at     = Carbon::now();
        $created_batch->quantity       = $request->quantity;
        $created_batch->barcode_number = generateBarcode(MaterialProducts::find($request->material_product_id)->category_selection);
        $created_batch->storage_area   = $request->storage_area;
        $created_batch->housing_type   = $request->housing_type;
        $created_batch->housing        = $request->housing;
        $created_batch->owner_one      = $request->owner_one;
        $created_batch->owner_two      = $request->owner_two;
        $created_batch->save();

        $current_batch->update([
            'quantity' =>   $current_batch->quantity -  $request->quantity
        ]);

        return response()->json([
            "status" => true,
            "message" => "Transfer Success !"
        ]);
    }
}