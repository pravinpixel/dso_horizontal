<?php

namespace App\Http\Controllers;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
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
        $material_product   =   MaterialProducts::find($request->material_product_id);

        Batches::find($request->id)->update([
            "quantity" => $request->quantity
        ]);
        
        MaterialProducts::find($request->material_product_id)->update([
            "quantity" =>  (int) $material_product->quantity -  (int) $request->quantity 
        ]); 
        
        $createdBatch       =   $material_product->Batches()->create($request->all());
        $Batches            =   Batches::find($createdBatch->id);

        $this->barCodeLabelRepository->generateBarcode($material_product, $Batches);

        return response()->json([
            "status" => true,
            "message" => "Transfer Success !"
        ]);
    }
}