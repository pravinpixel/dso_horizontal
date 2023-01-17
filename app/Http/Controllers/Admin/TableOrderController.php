<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tableOrder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TableOrderController extends Controller
{
    public function index(Request $request)
    { 
        if ($request->ajax()) { 
            $query = tableOrder::orderBy('order_by','asc')->get();
            $table = Datatables::of($query);
            $table->addColumn('action', function($row) {
                $on = $row->status == 1 ? "checked":"";
                return '<input type="checkbox" id="switch'.$row->id.'" '.$on.' onchange="changeOrder('.$row->id.')" data-switch="primary"/>
                        <label for="switch'.$row->id.'" data-on-label="On" data-off-label="Off"></label>';
            });
            $table->rawColumns(['action']); 
            $table->addIndexColumn();
            return  $table->make(true);
        }
        return view('masters.table-order.index');
    }
    public function store($id)
    {
        $tableOrder = tableOrder::findOrFail($id);
        $tableOrder->update([
            'status' => $tableOrder->status == 1 ? 0 : 1
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Success'
        ]);
    }
    public function update_order(Request $request)
    {
        foreach($request->input('rows', []) as $row) {
            tableOrder::find($row['id'])->update([
                'order_by' => $row['order_by']
            ]);
        }
        return response()->noContent();
    }
}