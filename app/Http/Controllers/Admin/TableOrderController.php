<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tableOrder;
use Illuminate\Http\Request;

class TableOrderController extends Controller
{
    public function index(Request $request)
    { 
        $table_orders   =   tableOrder::paginate(8);
        return view('masters.table-order.index', compact('table_orders'));
    }
    public function store(Request $request)
    {
        tableOrder::findOrFail($request->id)->update([
            'order_by'  =>  $request->order_by,
            'status'    =>  $request->status
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Success'
        ]);
    }
}