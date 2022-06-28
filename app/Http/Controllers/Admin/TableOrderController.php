<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tableOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TableOrderController extends Controller
{
    public function index(Request $request)
    { 
        return view('masters.table-order.index', compact('table_orders'));
    }
}