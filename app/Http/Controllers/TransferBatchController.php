<?php

namespace App\Http\Controllers;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransferBatchController extends Controller
{
    public function __construct(BarCodeLabelRepositoryInterface $barCodeLabelRepository)
    {
        $this->barCodeLabelRepository   =   $barCodeLabelRepository;
    }

    public function transfer(Request $request)
    {
        $current_batch              =   Batches::find($request->id);
        $created_batch              =   $current_batch->replicate();
        $created_batch->created_at  =   Carbon::now();
        $created_batch->quantity    =   $request->quantity;
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