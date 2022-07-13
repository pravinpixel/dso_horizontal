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
        $current_batch                  =   Batches::find($request->id);
        $created_batch                  =   $current_batch->replicate();
        $created_batch->created_at      =   Carbon::now();
        $created_batch->quantity        =   $request->quantity;
        $created_batch->barcode_number  =   generateBarcode(MaterialProducts::find($request->material_product_id)->category_selection);
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