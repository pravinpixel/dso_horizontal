<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableOrderController extends Controller
{
    public function index(Request $request)
    {
        return view('masters.table-order.index');
    }
}
