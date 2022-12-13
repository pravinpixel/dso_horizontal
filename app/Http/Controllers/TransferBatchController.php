<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransferBatchController extends Controller
{
    public function transfer(Request $request)
    {

        $current_batch                 = Batches::find($request->id);
        MaterialProductHistory($current_batch,'before_transfer');
        $created_batch                 = $current_batch->replicate();
        $created_batch->created_at     = Carbon::now();
        $created_batch->quantity       = $request->quantity;
        $created_batch->barcode_number = generateBarcode(MaterialProducts::find($request->material_product_id)->category_selection);
        $created_batch->storage_area   = $request->storage_area;
        $created_batch->housing_type   = $request->housing_type;
        $created_batch->housing        = $request->housing;
        $created_batch->total_quantity = $created_batch->unit_packing_value * $created_batch->quantity;
        $created_batch->save();

        MaterialProductHistory($created_batch,'after_transfer');

        RepackOutlife::updateOrCreate(['batch_id' => $created_batch->id], [
            'batch_id'            => $created_batch->id,
            'quantity'            => $created_batch->quantity,
            'total_quantity'      => $created_batch->quantity * $created_batch->unit_packing_value,
            'input_repack_amount' => $created_batch->unit_packing_value
        ]);

        if($request->owners) {
            foreach ($request->owners as $key => $owner) {
                $created_batch->BatchOwners()->updateOrCreate(["user_id" => $owner['id'],"batch_id" => $created_batch->id],[
                    "user_id"    =>  $owner['id'],
                    "alias_name" => getUserById($owner['id'])->alias_name
                ]);
            }
        }

        $old_value           = $current_batch;
        $new_value           = clone $current_batch;
        $new_value->quantity = $new_value->quantity  - $request->quantity;
        LogActivity::dataLog($old_value, $new_value);

        $current_batch->update([
            'quantity'       => $current_batch->quantity - $request->quantity,
            'total_quantity' => $current_batch->unit_packing_value * ($current_batch->quantity - $request->quantity)
        ]);
        MaterialProductHistory($current_batch,'transfer');

        return response()->json([
            "status" => true,
            "message" => "Transfer Success !"
        ]);
    }
}
