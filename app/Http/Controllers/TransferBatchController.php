<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $created_batch->total_quantity = $created_batch->unit_packing_value * $created_batch->quantity;
        $created_batch->save();
        cloneDocumentFromBatch($request->id,$created_batch->id); 
        if($request->owners) {
            $created_batch->owners = implode(",", Arr::pluck($request->owners, 'id'));
            $created_batch->save();
            foreach ($request->owners as $key => $owner) {
                $created_batch->BatchOwners()->updateOrCreate(["user_id" => $owner['id'],"batch_id" => $created_batch->id],[
                    "user_id"    =>  $owner['id'],
                    "alias_name" => getUserById($owner['id'])->alias_name
                ]);
            }
        }
        MaterialProductHistory($created_batch,'transfer');
        $old_value           = $current_batch;
        $new_value           = clone $current_batch;
        $new_value->quantity = $new_value->quantity  - $request->quantity;
        LogActivity::dataLog($old_value, $new_value);
        $current_batch->update([
            'quantity'       => $current_batch->quantity - $request->quantity,
            'total_quantity' => $current_batch->unit_packing_value * ($current_batch->quantity - $request->quantity)
        ]);
        return response()->json([
            "status" => true,
            "message" => "Transfer Success !"
        ]);
    }
}
