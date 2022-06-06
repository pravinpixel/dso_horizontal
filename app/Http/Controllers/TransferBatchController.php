<?php

namespace App\Http\Controllers;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Illuminate\Http\Request;

class TransferBatchController extends Controller
{
    public function __construct(BarCodeLabelRepositoryInterface $barCodeLabelRepository)
    {
        $this->barCodeLabelRepository   =   $barCodeLabelRepository;
    }

    public function transfer(Request $request)
    {
        $material_product   =   MaterialProducts::find($request->material_product_id);
        $createdBatch       =   $material_product->Batches()->create($request->all());
        $Batches            =   Batches::find($createdBatch->id);

        $this->barCodeLabelRepository->generateBarcode($material_product, $Batches);

        return response()->json([
            "status" => true,
            "message" => "Transfer Success !"
        ]);
    }
}