<?php

namespace App\Http\Controllers;
use App\Models\Batches;
use App\Models\DeductTrackUsage;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use App\Models\withdrawCart;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        $direct_deducts = withdrawCart::with('batch')->where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => 'DIRECT_DEDUCT'
        ])->get();
        $deduct_track_usage = withdrawCart::where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => 'DEDUCT_TRACK_USAGE'
        ])->get();
        $deduct_track_outlife_data = withdrawCart::with('RepackOutlife')->where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
        ])->get();

        $deduct_track_outlife = [];
        foreach ($deduct_track_outlife_data as $key => $value) {

            $RepackOutlife = [];
            foreach ($value->RepackOutlife->toArray() as $key => $repack) {
                if($repack['updated_outlife_seconds']) {
                    $repack['item_description'] = Batches::find($repack['batch_id'])->BatchMaterialProduct->item_description;
                    $RepackOutlife[] = $repack;
                }
            }
            if(count($RepackOutlife))    {
                $value['RepackOutlife'] = $RepackOutlife;
                $value['barcode_number'] = Batches::find($value['batch_id'])->barcode_number ;
                $deduct_track_outlife[] = $value;
            }
        }
        return  view('crm.material-products.withdrawal.index', compact('direct_deducts','deduct_track_usage','deduct_track_outlife'));
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
        $records = withdrawCart::with('batch')->where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => $type
        ])->get();

        switch ($type) {
            case 'DIRECT_DEDUCT':
                $direct_deducts = $records;
                $table_view     = view('crm.material-products.withdrawal.direct-deduct', compact('direct_deducts'));
            break;
            case 'DEDUCT_TRACK_USAGE':
                $deduct_track_usage = $records;
                $table_view         = view('crm.material-products.withdrawal.deduct-track-useage', compact('deduct_track_usage'));
            break;
            case 'DEDUCT_TRACK_OUTLIFE':
                $deduct_track_outlife_data = withdrawCart::with('RepackOutlife')->where([
                    'user_id'       => auth_user()->id,
                    'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
                ])->get();

                $deduct_track_outlife = [];
                foreach ($deduct_track_outlife_data as $key => $value) {

                    $RepackOutlife = [];
                    foreach ($value->RepackOutlife->toArray() as $key => $repack) {
                        if($repack['updated_outlife_seconds']) {
                            $repack['item_description'] = Batches::find($repack['batch_id'])->BatchMaterialProduct->item_description;
                            $RepackOutlife[] = $repack;
                        }
                    }
                    if(count($RepackOutlife))    {
                        $value['RepackOutlife'] = $RepackOutlife;
                        $value['barcode_number'] = Batches::find($value['batch_id'])->barcode_number ;
                        $deduct_track_outlife[] = $value;
                    }
                }

                $table_view = view('crm.material-products.withdrawal.deduct-track-outlife', compact('deduct_track_outlife'));
            break;
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
        $direct_deduct = withdrawCart::where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => 'DIRECT_DEDUCT'
        ])->count();
        $deduct_track_usage = withdrawCart::where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => 'DEDUCT_TRACK_USAGE'
        ])->count();
        $deduct_track_outlife = withdrawCart::where([
            'user_id'       => auth_user()->id,
            'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
        ])->count();
        return response()->json([
            'direct_deduct'        => $direct_deduct,
            'deduct_track_usage'   => $deduct_track_usage,
            'deduct_track_outlife' => $deduct_track_outlife,
        ]);
    }
    public function withdrawal_indexing($barcode)
    {
        try {
            $batches  = Batches::where('barcode_number', $barcode)->first();

            switch ($batches->withdrawal_type) {
                case 'DIRECT_DEDUCT':
                    $withdraw_cart = withdrawCart::with('batch')->where([
                        'user_id'  => auth_user()->id,
                        'batch_id' => $batches->id
                    ])->get();

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
                                $currentQty = $row->quantity += 1;
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

                    if(count($batches->RepackOutlife)) {
                        withdrawCart::updateOrCreate([
                            'user_id'       => auth_user()->id,
                            'batch_id'      => $batches->id,
                            'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE',
                            'quantity'      => 1,
                        ]);

                        $deduct_track_outlife_data = withdrawCart::with('RepackOutlife')->where([
                            'user_id'       => auth_user()->id,
                            'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
                        ])->get();

                        $deduct_track_outlife = [];
                        foreach ($deduct_track_outlife_data as $key => $value) {

                            $RepackOutlife = [];
                            foreach ($value->RepackOutlife->toArray() as $key => $repack) {
                                if($repack['updated_outlife_seconds'] != '' || $repack['updated_outlife_seconds'] != null) {
                                    $repack['item_description'] = Batches::find($repack['batch_id'])->BatchMaterialProduct->item_description;
                                    $RepackOutlife[] = $repack;
                                }
                            }
                            if(count($RepackOutlife)) {
                                $value['RepackOutlife'] = $RepackOutlife;
                                $value['barcode_number'] = Batches::find($value['batch_id'])->barcode_number ;
                                $deduct_track_outlife[] = $value;
                            }
                        }

                        // $deduct_track_outlife = withdrawCart::with(['batch','RepackOutlife'])->where([
                        //     'user_id'         => auth_user()->id ,
                        //     'withdraw_type'   => 'DEDUCT_TRACK_OUTLIFE'
                        // ])->get();


                        $data = view('crm.material-products.withdrawal.deduct-track-outlife', compact('deduct_track_outlife'));

                        return response([
                            'status'        => true,
                            'data'          => "$data",
                            'withdraw_type' => 'DEDUCT_TRACK_OUTLIFE'
                        ]);
                    }
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
            MaterialProductHistory($current_batch,'BEFORE_DIRECT_DEDUCT');
            $current_batch->UtilizationCart()->create(["quantity" =>  $request->quantity[$key]]);
            $current_batch->update([
                'quantity'  =>  $current_batch->quantity -  $request->quantity[$key]
            ]);
            MaterialProductHistory($current_batch,'AFTER_DIRECT_DEDUCT');
            withdrawCart::with('batch')->where([
                'user_id'       => auth_user()->id ,
                'withdraw_type' => 'DIRECT_DEDUCT'
            ])->delete();

        }
        return redirect()->back()->with("success_message", __('global.direct_deduct_success'));
    }
    public function deduct_track_usage_clear()
    {
        withdrawCart::where('withdraw_type','DEDUCT_TRACK_USAGE')->delete();
        return redirect()->back()->with("success_message", __('global.cart_clear_success'));
    }
    public function deduct_track_usage(Request $request)
    {
        $batch      = Batches::with('StorageArea')->findOrFail($request->batch_id);
        $material   = MaterialProducts::find($batch->material_product_id);
        MaterialProductHistory($batch,'BEFORE_DEDUCT_TRACK_USAGE');

        DeductTrackUsage::create([
            'batch_id'           => $request->batch_id,
            "quantity"           => $batch->quantity,
            'barcode_number'     => $batch->barcode_number,
            'item_description'   => $material->item_description,
            'batch_serial'       => $batch->batch . ' / ' . $batch->serial,
            'last_accessed'      => auth_user()->alias_name,
            'used_amount'        => $request->used_amount,
            'remain_amount'      => $request->remain_amount,
            'remarks'            => $request->remarks ?? "",
            'brand'              => $batch->batch,
            'unit_packing_value' => $material->unit_packing_value,
            'storage_area'       => $batch->StorageArea->name,
            'housing'            => $batch->housing,
        ]);

        $batch->UtilizationCart()->create(["quantity" =>  $batch->quantity -  $request->remain_amount / $batch->unit_packing_value]);

        $batch->update([
            "total_quantity" => (float) $request->remain_amount,
            "quantity"       => $request->remain_amount / $batch->unit_packing_value
        ]);
        MaterialProductHistory($batch,'AFTER_DEDUCT_TRACK_USAGE');
        $material->update([
            "end_of_material_product" => $request->end_of_material_product == 1 ? true : false
        ]);
        withdrawCart::where('withdraw_type','DEDUCT_TRACK_USAGE')->delete();
        return redirect()->back()->with("success_message", __('global.deduct_track_usage_success'));
    }
    public function deduct_track_outlife(Request $request)
    {
        foreach ($request->id as $key => $row) {
            $repackOutlife = RepackOutlife::find($request->id[$key]);
            MaterialProductHistory($repackOutlife,'BEFORE_DEDUCT_TRACK_OUTLIFE');
            $repackOutlife->update([
                'remarks' => $request->remarks[$key],
            ]);
            MaterialProductHistory($repackOutlife,'AFTER_DEDUCT_TRACK_OUTLIFE');
        }
        withdrawCart::where('withdraw_type','DEDUCT_TRACK_OUTLIFE')->delete();
        if($request->print_outlife_expiry == 1) {
            return redirect(route('print.barcode', RepackOutlife::find($request->id[0])->batch_id));
        }
        return redirect()->back();
    }
}
