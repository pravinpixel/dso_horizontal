<?php

namespace App\Http\Controllers;

use App\Exports\RepackOutlifeExport;
use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RepackBatchController extends Controller
{

    public function repack(Request $request)
    { 
         
        $previous_batch                = Batches::find($request->id);
        $new_batch                     = $previous_batch->replicate();
        $new_batch->created_at         = Carbon::now();
        $new_batch->barcode_number     = generateBarcode(MaterialProducts::find($request->material_product_id)->category_selection);
        $new_batch->quantity           = $request->AutoCalQty;
        $new_batch->total_quantity     = $request->new_unit_packing_value * $request->AutoCalQty;
        $new_batch->unit_packing_value = $request->new_unit_packing_value;
        $new_batch->storage_area       = $request->storage_area['id'] ?? $request->storage_area;
        $new_batch->housing_type       = $request->housing_type['id'] ?? $request->housing_type;
        $new_batch->housing            = $request->housing;
        $new_batch->iqc_status         = 0;
        // $new_batch->repack_size        = $request->RepackQuantity;
        $new_batch->save();


        if($request->owners) {
            foreach ($request->owners as $key => $owner) {
                $new_batch->BatchOwners()->updateOrCreate(["user_id" => $owner['id'],"batch_id" => $new_batch->id],[
                    "user_id"    =>  $owner['id'],
                    "alias_name" => getUserById($owner['id'])->alias_name
                ]);
            }
        }

        $old_value             = $previous_batch;
        $new_value             = clone $previous_batch;
        $new_value->quantity   = $request->RemainQuantity;

        LogActivity::dataLog($old_value, $new_value);

        $previous_batch->update([
            'quantity'       => $request->RemainQuantity,
            'total_quantity' => $previous_batch->unit_packing_value * $request->RemainQuantity,
            // 'unit_packing_value' => $previous_batch->unit_packing_value  - $request->input_used_amount,
        ]);

        return response()->json([
            "status"  => true,
            "message" => "Repack / Transfer Success !"
        ]); 
    }
    public static function get_repack_outlife($id)
    {
        $Batches    =    Batches::with('RepackOutlife')->find($id);
 
        $users = [];
        if(!is_null($Batches->access)) {
            foreach(json_decode($Batches->access) as $user_id) {
                $users[] = User::find($user_id)->alias_name;
            }
            $Batches->access = json_encode($users[0]);
        } 
        return $Batches;
    }
    public function repack_outlife (Request $request, $id)
    {
        if($request->repack_id) {
            RepackOutlife::find($request->repack_id)->update(["id" => $request->repack_id]);
            Batches::find($id)->update(['quantity' => $request->quantity - $request->Draw_input_repack_amt]);
            return response()->json([
                "status"    => true,
                "message"   => "Success !"
            ]);
        }

        RepackOutlife::create([
            'batch_id'              => $id, 
            'quantity'              => $request->quantity, 
            'draw_in_time_stamp'    => date("Y-m-d h:i:sa"),
            'draw_out_time_stamp'   => '-',
            'draw_in_last_access'   => json_encode($request->access),
            'draw_out_last_access'  => json_encode($request->access),
            'input_repack_amount'   => $request->Draw_input_repack_amt,
            'remain_amount'         => $request->quantity - $request->Draw_input_repack_amt,
            'repack_size'           => $request->Draw_repack_size,
            'qty_cut'               => $request->Draw_qty_cut,
        ]);

        Batches::find($id)->update(['quantity' => $request->quantity - $request->Draw_input_repack_amt]);

        return response()->json([
            "status"    => true,
            "message"   => "Success !"
        ]);
    }

    public function store_repack_outlife(Request $request , $id)
    {
        foreach ($request->data as $key => $row) {
            if($request->repack_id == $row['id']) {
                $repackData = RepackOutlife::find($row['id']);
                $Batches    = Batches::find($repackData->batch_id);

                if($row['draw_out']['status'] == 0 && $row['draw_in']['status'] == 1) {
                    Log::info("Draw OUT");
                    $draw_out      = 1;
                    $draw_in       = 0;
                 
                    $current_batch                  = Batches::find($repackData->batch_id);
                    $next_batch                     = $current_batch->replicate();
                    $next_batch->created_at         = Carbon::now();
                    $next_batch->barcode_number     = generateBarcode(MaterialProducts::find($current_batch->material_product_id)->category_selection);
                    $next_batch->unit_packing_value = $row['repack_size'];
                    $next_batch->total_quantity     = $row['repack_amount'];
                    $next_batch->quantity           = $row['quantity'];
                    $next_batch->save();

                    LogActivity::tracker([
                        "from"           => $current_batch->id,
                        "to"             => $next_batch->id,
                        "type"           => "REPACK_OUTLIFE",
                        "action_by"      => auth_user()->alias_name,
                    ]);

                    $current_batch->quantity       =  number_format($row['balance_amount'] /  $current_batch->unit_packing_value,3,".","");
                    $current_batch->total_quantity =  $row['balance_amount'];
                    $current_batch->save();

                    RepackOutlife::create([
                        'batch_id'       => $next_batch->id,
                        'total_quantity' => $row['repack_amount'],
                    ]);

                    // RepackOutlife::create([
                    //     'batch_id'            => $id,
                    //     'input_repack_amount' => $row['repack_size'],
                    //     'total_quantity'      => $row['balance_amount'],
                    // ]);

                    $old_value           = $current_batch;
                    $new_value           = clone $current_batch;
                    LogActivity::dataLog($old_value, $new_value);
                }

                if($row['draw_out']['status'] == 1 && $row['draw_in']['status'] == 0) {
                    Log::info("Draw IN");

                    $draw_out   = 1;
                    $draw_in    = 1;

                    if($Batches->unit_packing_value != 0) {
                        RepackOutlife::create([
                            'batch_id'            => $id,
                            'input_repack_amount' => $row['repack_size'],
                            'total_quantity'      => $row['balance_amount']
                        ]);
                    }

                    if($Batches->outlife_seconds === null) {
                        $updated_outlife_seconds    =  (int) $Batches->outlife * 86400 - (int) substr_replace($row['remaining_days_seconds'] ,"", -3);
                    } else {
                        $updated_outlife_seconds    =  (int) $Batches->outlife_seconds - (int) substr_replace($row['remaining_days_seconds'] ,"", -3);
                    }
                    
                    $dt1                     =  new DateTime("@0");
                    $dt2                     =  new DateTime("@$updated_outlife_seconds");
                    $updated_outlife         =  $dt1->diff($dt2)->format('%a days, %h hours, %i minutes and %s seconds');
                    $current_outlife_expiry  =  CarbonImmutable::now()->add($updated_outlife_seconds, 'second')->toDateTimeString();
                    
                    $Batches->update([
                        'outlife_seconds' => $updated_outlife_seconds,
                        'outlife'         => $updated_outlife,
                    ]); 
                }
                 
                RepackOutlife::find($row['id'])->update([
                    'draw_in'                 => $draw_in,
                    'draw_in_time_stamp'      => $row['draw_in']['time_stamp'],
                    'draw_out'                => $draw_out,
                    'quantity'      => $row['quantity'],
                    'draw_out_time_stamp'     => $row['draw_out']['time_stamp'], 
                    'remain_amount'           => $row['balance_amount'],
                    'repack_size'             => $row['repack_size'],
                    'barcode_number'          => $row['barcode_number'],
                    'remain_days'             => $row['remaining_days'],
                    'remaining_days_seconds'  => $row['remaining_days_seconds'] ?? null,
                    'current_date_time'       => Carbon::now()->toDateTimeLocalString(),
                    'updated_outlife'         => $updated_outlife ?? null,
                    'updated_outlife_seconds' => $updated_outlife_seconds ?? null,
                    'current_outlife_expiry'  => $current_outlife_expiry ?? null,
                ]);

                return response()->json([
                    "status"    => true,
                    "message"   => "Success !"
                ]);
            }
        }
    }
    public function export_repack_outlife($id)
    {
        $excel_file_name = "Repack-Outlife-".date("Y-M-d  h-i-s A").".xlsx";
        return Excel::download(new RepackOutlifeExport($id), $excel_file_name);
    }
}