<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PrintBarcodeController extends Controller
{
    public function index(Request $request)
    {
        return view('crm.print-barcode.index');
    }
}
