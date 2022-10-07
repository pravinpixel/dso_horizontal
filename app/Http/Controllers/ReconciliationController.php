<?php

namespace App\Http\Controllers;

use App\Exports\ReconciliationExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReconciliationController extends Controller
{
    public function index()
    {
        return view('crm.reconciliation.index');
    }
    public function show()
    {
        return view('crm.reconciliation.view');
    }
    public function download()
    {
        return Excel::download(new ReconciliationExport, 'data.xlsx');
    }
}