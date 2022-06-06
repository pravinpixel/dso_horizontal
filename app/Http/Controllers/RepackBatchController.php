<?php

namespace App\Http\Controllers;

use App\Models\MaterialProducts;
use Illuminate\Http\Request;

class RepackBatchController extends Controller
{
    public function repack(Request $request)
    {
        $data    =   MaterialProducts::find($request->material_product_id);
        $data->Batches()->create($request->all());

        return response()->json([
            "status"  => true,
            "message" => "Transfer Success !"
        ]);
    }
}
