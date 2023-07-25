<?php

namespace App\Http\Controllers;
use App\Models\Batches;
use App\Models\DeductTrackUsage;
use App\Models\MaterialProducts;
use App\Models\withdrawCart;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function  getWithdrawal($type = null)
    {
        if(is_null($type)) {
            $direct_deducts = withdrawCart::with('batch')->where([
                'user_id'       => auth_user()->id,
                'withdraw_type' => 'DIRECT_DEDUCT'
            ])->get();
            $deduct_track_usage = withdrawCart::where([
                'user_id'       => auth_user()->id,
                'withdraw_type' => 'DEDUCT_TRACK_USAGE'
            ])->get();
            $deduct_track_outlife = withdrawCart::with('batch','RepackOutlife')->where([
                'user_id'       => auth_user()->id,
                'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
            ])->get();
            return [
                "direct_deducts"       => $direct_deducts,
                "deduct_track_usage"   => $deduct_track_usage,
                "deduct_track_outlife" => $deduct_track_outlife,
            ];
        } else {
            return withdrawCart::with('batch','RepackOutlife')->where([
                'user_id'       => auth_user()->id,
                'withdraw_type' => $type
            ])->get();
        } 
    }
    public function index()
    {
        $result               = $this->getWithdrawal();
        $direct_deducts       = $result['direct_deducts'];
        $deduct_track_usage   = $result['deduct_track_usage'];
        $deduct_track_outlife = $result['deduct_track_outlife'];
        session()->put('page_name','WITHDRAWAL');
        return  view('crm.material-products.withdrawal.index', compact(
            'direct_deducts',
            'deduct_track_usage',
            'deduct_track_outlife'
        ));
    }
    public function decrease_quantity($id)
    {
        $result = withdrawCart::find($id);
        $result ->update([
            'quantity' => $result->quantity - 1
        ]);
        return response([
            'status'        =>  true,
            "withdraw_type" => $result->withdraw_type
        ]);
    }
    public function get_withdrawal_data($type)
    {
        $result               = $this->getWithdrawal();
        $direct_deducts       = $result['direct_deducts'];
        $deduct_track_usage   = $result['deduct_track_usage'];
        $deduct_track_outlife = $result['deduct_track_outlife'];

        if($type === 'DIRECT_DEDUCT') {
            $table_view = view('crm.material-products.withdrawal.direct-deduct', compact('direct_deducts'));
        } elseif($type === 'DEDUCT_TRACK_USAGE') {
            $table_view = view('crm.material-products.withdrawal.deduct-track-useage', compact('deduct_track_usage'));
        } elseif($type === 'DEDUCT_TRACK_OUTLIFE') {
            $table_view = view('crm.material-products.withdrawal.deduct-track-outlife', compact('deduct_track_outlife'));
        }

        return response([
            'status'        =>  true,
            'data'          =>  "$table_view",
            'withdraw_type' =>  $type
        ]);
    }
    public function delete_withdraw_cart($id)
    {
        $data = withdrawCart::find($id);
        $type = $data->withdraw_type;
        $data->delete();
        return response([
            'status'        =>  true,
            "withdraw_type" => $type
        ]);
    }
    public function withdraw_cart_count()
    {
        $result = $this->getWithdrawal();
        return response()->json([
            'direct_deduct'        => count($result['direct_deducts']),
            'deduct_track_usage'   => count($result['deduct_track_usage']),
            'deduct_track_outlife' => count($result['deduct_track_outlife'])
        ]);
    }
    public function withdrawal_indexing($barcode)
    {
        try {
            $batches  = Batches::where('barcode_number', $barcode)
            ->where('end_of_batch', 0)
            ->where('is_draft', 0)->first();

            switch ($batches->withdrawal_type) {
                case 'DIRECT_DEDUCT':
                    $withdraw_cart = withdrawCart::with('batch')->where([
                        'user_id'  => auth_user()->id,
                        'batch_id' => $batches->id
                    ])->get();
                         
                    if($batches->quantity < 1) {
                        return 404; 
                    }

                    if(count($withdraw_cart) == 0) {
                        withdrawCart::create([
                            'user_id'       => auth_user()->id,
                            'batch_id'      => $batches->id,
                            'withdraw_type' => $batches->withdrawal_type,
                            'quantity'      => 1,
                        ]);
                    } else {
                        foreach($withdraw_cart as $row) {
                            if($row->batch_id == $batches->id) {
                                $currentQty = $row['quantity'] += 1;
                                if($batches->quantity < $currentQty) {
                                    return 404;
                                } else {
                                    withdrawCart::find($row->id)->update([
                                        'quantity'  =>  $currentQty
                                    ]);
                                }
                            }
                        }
                    }
                    $direct_deducts = withdrawCart::with('batch')->where([
                        'user_id'       => auth_user()->id ,
                        'withdraw_type' => 'DIRECT_DEDUCT'
                    ])->get();

                    $data = view('crm.material-products.withdrawal.direct-deduct', compact('direct_deducts'));

                    return response([
                        'status' => true,
                        'data'   => "$data",
                        'withdraw_type' => 'DIRECT_DEDUCT'
                    ]);
                break;
                case 'DEDUCT_TRACK_USAGE' :
                    withdrawCart::updateOrCreate([
                        'user_id'       => auth_user()->id,
                        'batch_id'      => $batches->id,
                        'withdraw_type' => 'DEDUCT_TRACK_USAGE',
                        'quantity'      => 1,
                    ]);

                    $deduct_track_usage_history = DeductTrackUsage::where(['batch_id' => $batches->id])->get();

                    $deduct_track_usage = withdrawCart::with('batch')->where([
                        'user_id'       => auth_user()->id ,
                        'withdraw_type' => 'DEDUCT_TRACK_USAGE'
                    ])->get();

                    $data = view('crm.material-products.withdrawal.deduct-track-useage', compact('deduct_track_usage','deduct_track_usage_history'));

                    return response([
                        'status'        => true,
                        'data'          => "$data",
                        'withdraw_type' => 'DEDUCT_TRACK_USAGE'
                    ]);
                break;
                case 'DEDUCT_TRACK_OUTLIFE' :
                    withdrawCart::updateOrCreate([
                        'user_id'       => auth_user()->id,
                        'batch_id'      => $batches->id,
                        'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE',
                        'quantity'      => 1,
                    ]);
                    $deduct_track_outlife = withdrawCart::with('RepackOutlife')->where([
                        'user_id'       => auth_user()->id,
                        'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
                    ])->get();
             
                    $data = view('crm.material-products.withdrawal.deduct-track-outlife', compact('deduct_track_outlife'));

                    return response([
                        'status'        => true,
                        'data'          => "$data",
                        'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
                    ]);
                break;
            }
        } catch (\Throwable $th) {
            return 404;
        }
    }
    public function direct_deduct(Request $request)
    { 
        foreach ($request->batch_id as $key => $column) {
            $current_batch = Batches::find($request->batch_id[$key]);
            $current_batch->UtilizationCart()->create(["quantity" =>  $request->quantity[$key]]);
            $report_current_batch = clone collect($current_batch);
            $report_current_batch['quantity']       = $request->quantity[$key];
            $report_current_batch['remarks']       = $request->remarks[$key];
            $report_current_batch['total_quantity'] = $request->quantity[$key] * $current_batch->unit_packing_value;
            MaterialProductHistory($report_current_batch,'DIRECT_DEDUCT');
            $current_batch->update([
                'quantity'       => $current_batch->quantity -  $request->quantity[$key],
                'total_quantity' => ($current_batch->quantity -  $request->quantity[$key]) * $current_batch->unit_packing_value
            ]);
            withdrawCart::with('batch')->where([
                'user_id'       => auth_user()->id ,
                'withdraw_type' => 'DIRECT_DEDUCT'
            ])->delete();
        }
        updateParentQuantity($request->material_product_id);
        return redirect()->back()->with("success_message", __('global.direct_deduct_success'));
    }
    public function deduct_track_usage_clear()
    {
        withdrawCart::where('withdraw_type','DEDUCT_TRACK_USAGE')->delete();
        return redirect()->back()->with("success_message", __('global.cart_clear_success'));
    }
    public function deduct_track_usage(Request $request)
    { 
        $current_batch  = Batches::with('StorageArea')->findOrFail($request->batch_id);
        $material       = MaterialProducts::find($current_batch->material_product_id);
        // MaterialProductHistory($current_batch,'BEFORE_DEDUCT_TRACK_USAGE');

        DeductTrackUsage::create([
            'batch_id'           => $request->batch_id,
            "quantity"           => $current_batch->quantity,
            'barcode_number'     => $current_batch->barcode_number,
            'item_description'   => $material->item_description,
            'batch_serial'       => $current_batch->batch . ' / ' . $current_batch->serial,
            'last_accessed'      => auth_user()->alias_name,
            'used_amount'        => $request->used_amount,
            'remain_amount'      => $request->end_of_material_product == 1 ? ($request->used_amount == 0 ? "0" : $request->remain_amount) : $request->remain_amount,
            'remarks'            => $request->remarks ?? "",
            'brand'              => $current_batch->batch,
            'unit_packing_value' => $material->unit_packing_value,
            'storage_area'       => $current_batch->StorageArea->name,
            'housing'            => $current_batch->housing,
        ]);
        $current_batch->UtilizationCart()->create(["quantity" =>  $current_batch->quantity -  $request->remain_amount / $current_batch->unit_packing_value]);
        
        if($request->end_of_material_product == 1) {
            $current_batch->update([
                "end_of_batch"   => 1,
                "quantity"       => 0,
                "total_quantity" => 0
            ]);
            $material->update([
                "end_of_material_product" => true
            ]); 
            $current_batch['remarks']       = $request->remarks;

            MaterialProductHistory($current_batch,'DEDUCT_TRACK_USAGE');
        } else {
            $report_current_batch = clone collect($current_batch);
            $report_current_batch['quantity']   = $request->used_amount;
            $report_current_batch['remarks']       = $request->remarks;
            MaterialProductHistory($report_current_batch,'DEDUCT_TRACK_USAGE');
            $current_batch->update([
                'quantity'       => $request->remain_amount  / $current_batch->unit_packing_value,
                'total_quantity' => $request->remain_amount,
                "end_of_batch"   => 0
            ]);
        } 
        
        withdrawCart::where('withdraw_type','DEDUCT_TRACK_USAGE')->delete();
        updateParentQuantity( $current_batch->material_product_id);
        return redirect()->back()->with("success_message", __('global.deduct_track_usage_success'));
    }
    public function deduct_track_outlife(Request $request)
    { 
        foreach ($request->batch_id as $key => $batch_id) {
            if(isset($request->withdraw_quantity[$key])) {
                $batch  = Batches::with('BatchMaterialProduct')->find($batch_id); 
                $batch->TrackOutlifeHistory()->create([
                    'type'               => $request->cart_type[$key],
                    'item_description'   => $batch->BatchMaterialProduct->item_description,
                    'batch_serial'       => $batch->batch.' / '.$batch->serial,
                    'last_accessed'      => auth_user()->alias_name,
                    'unit_packing_value' => $batch->unit_packing_value,
                    'quantity'           => $batch->quantity,
                    'total_quantity'     => $batch->total_quantity,
                    'withdraw_quantity'  => $request->withdraw_quantity[$key],
                    'remarks'            => $request->remarks[$key] ?? "-"
                ]);
                $batch->UtilizationCart()->create(["quantity" =>  $request->withdraw_quantity[$key] / $batch->unit_packing_value ]);
                $report_current_batch = clone collect($batch);
                $report_current_batch['quantity'] = $request->withdraw_quantity[$key];
                $report_current_batch['remarks'] = $request->remarks[$key] ?? "-";
                MaterialProductHistory($report_current_batch,'DEDUCT_TRACK_OUTLIFE');
                $total_quantity = $batch->total_quantity - $request->withdraw_quantity[$key]; 
                $batch->update([
                    'remarks'        => $request->remarks[$key],
                    'quantity'       => $total_quantity / $batch->unit_packing_value,
                    'total_quantity' => $total_quantity
                ]);
                updateParentQuantity($batch->material_product_id);
            }
        }
        withdrawCart::where('withdraw_type','DEDUCT_TRACK_OUTLIFE')->delete();
        if($request->print_outlife_expiry == 1) { 
            return redirect(route('print.barcode', $request->batch_id[0]));
        }
        return redirect()->back()->with("success_message", __('global.deduct_track_usage_success'));
    }
}