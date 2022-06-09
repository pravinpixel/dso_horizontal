<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use Illuminate\Http\Request;

class PrintBarcodeController extends Controller
{
    public function __construct(DsoRepositoryInterface $dsoRepositoryInterface){
        $this->dsoRepository    =   $dsoRepositoryInterface;
    }

    public function index(Request $request)
    {
        $page_name  = "PRINT_BARCODE_LABEL";
        $view       = "crm.print-barcode.index";
        return $this->dsoRepository->renderPage($page_name, $view);
    }

    public function show($id)
    {
        $batch = Batches::with('BatchMaterialProduct')->findOrFail($id);
        return view('crm.print-barcode.show', compact('batch'));
    }

    public function print(Request $request)
    {
        $printData = $request->data;
        dd($printData);
    }
}