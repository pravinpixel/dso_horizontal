<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
}
