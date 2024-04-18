<?php

namespace App\Http\Controllers;

use App\Exports\RepackOutlifeExport;
use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\materialProductHistory;
use App\Models\MaterialProducts;
use App\Models\RepackOutlife;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        $new_batch->save();
        cloneDocumentFromBatch($request->id, $new_batch->id);
        if ($request->owners) {
            $new_batch->owners = implode(",", Arr::pluck($request->owners, 'id'));
            $new_batch->save();
            foreach ($request->owners as $key => $owner) {
                $new_batch->BatchOwners()->updateOrCreate(["user_id" => $owner['id'], "batch_id" => $new_batch->id], [
                    "user_id"    =>  $owner['id'],
                    "alias_name" => getUserById($owner['id'])->alias_name
                ]);
            }
        }
        MaterialProductHistory($new_batch, 'Repack / Transfer');
        $old_value             = $previous_batch;
        $new_value             = clone $previous_batch;
        $new_value->quantity   = $request->RemainQuantity;

        $previous_batch->update([
            'quantity'       =>   $request->RemainQuantity / $previous_batch->unit_packing_value,
            'total_quantity' =>  $request->RemainQuantity,
        ]);
        return response()->json([
            "status"  => true,
            "message" => "Repack / Transfer Success !"
        ]);
    }
    public static function get_repack_outlife($id)
    {
        $batch    =   Batches::with('RepackOutlife')->find($id);
        if (count($batch->RepackOutlife) == 0) {
            $batch->RepackOutlife()->create([
                'input_repack_amount' => $batch->unit_packing_value
            ]);
        }
        $batch    =   Batches::with('RepackOutlife')->find($id);
        $users = [];
        if (!is_null($batch->access)) {
            foreach (json_decode($batch->access) as $user_id) {
                $users[] = User::find($user_id)->alias_name;
            }
            $batch->access = json_encode($users[0]);
        }
        return $batch;
    }
    public function store_repack_outlife(Request $request, $id)
    {
        foreach ($request->data as $key => $row) {
            if ($request->repack_id == $row['id']) {
                $repackData = RepackOutlife::find($row['id']);
                $Batches    = Batches::find($repackData->batch_id);
                if ($row['draw_out']['status'] == 0 && $row['draw_in']['status'] == 1) {
             $repacks=RepackOutlife::where('batch_id',$repackData->batch_id)->where('draw_in',0)->where('id','!=',$row['id'])->get();
                       //dd($repacks);
                       foreach($repacks as $repack_data){
                        $repack_outlife=RepackOutlife::find($repack_data->id);
                        $repack_outlife->draw_in_disabled=1;
                        $repack_outlife->save();

                       }
                    $Batches['quantity']            = $row['quantity'];
                    $current_batch                   = Batches::find($repackData->batch_id);
                     MaterialProductHistory($current_batch, 'Repack_Outlife_Draw_OUT');
                    $next_batch                      = $current_batch->replicate(); 
                    $next_batch->created_at          = Carbon::now();
                    $next_batch->unit_packing_value  = $row['repack_size'];
                    $next_batch->total_quantity      = $row['repack_amount'];
                    $next_batch->quantity            = $row['quantity'];
                    $next_batch->save();
                   

                    $next_batch->barcode_number = generateBarcode(MaterialProducts::find($current_batch->material_product_id)->category_selection);
                    $next_batch->save();

                    cloneDocumentFromBatch($repackData->batch_id, $next_batch->id);
                    if (count($current_batch->BatchOwners)) {
                        foreach ($current_batch->BatchOwners as $key => $user) {
                            $next_batch->BatchOwners()->updateOrCreate(["user_id" => $user['id'], "batch_id" => $next_batch->id], [
                                "user_id"    => $user['user_id'],
                                "alias_name" => getUserById($user['user_id'])->alias_name
                            ]);
                        }
                    }

                    LogActivity::tracker([
                        "from"           => $current_batch->id,
                        "to"             => $next_batch->id,
                        "type"           => "REPACK_OUTLIFE",
                        "action_by"      => auth_user()->alias_name,
                    ]);

                    $current_batch->quantity       =  number_format($row['balance_amount'] /  $current_batch->unit_packing_value, 3, ".", "");
                    $current_batch->total_quantity =  $row['balance_amount'];
                    $current_batch->save();

                    $old_value           = $current_batch;
                    $new_value           = clone $current_batch;
                    LogActivity::dataLog($old_value, $new_value);

                    RepackOutlife::find($row['id'])->update([
                        'draw_in'                 => 0,
                        'draw_in_time_stamp'      => $row['draw_in']['time_stamp'],
                        'draw_out'                => 1,
                        'quantity'                => $row['quantity'],
                        'draw_out_time_stamp'     => $row['draw_out']['time_stamp'],
                        'remain_amount'           => $row['balance_amount'],
                        'repack_size'             => $row['repack_size'],
                        'barcode_number'          => $row['barcode_number'],
                        'old_input_repack_amount' => $row['repack_amount'],
                        'draw_in_last_access'     => auth_user()->alias_name,
                    ]);
                     RepackOutlife::create([
                            'batch_id'            => $id,
                            'input_repack_amount' => $row['repack_size'],
                            'total_quantity'      => $row['balance_amount']
                        ]);
                    RepackOutlife::find($row['id'])->update([
                        'user_id'                 => auth_user()->id,
                        'current_date_time'       => Carbon::now()->toDateTimeLocalString()
                       ]);
                 MaterialProductHistory($next_batch, 'Child_Batch_Created'); 
                }
                if ($row['draw_out']['status'] == 1 && $row['draw_in']['status'] == 0) {
                    $repacks=RepackOutlife::where('batch_id',$repackData->batch_id)->where('draw_in',0)->where('id','!=',$row['id'])->get();
                       //dd($repacks);
                       foreach($repacks as $repack_data){
                        $repack_outlife=RepackOutlife::find($repack_data->id);
                        $repack_outlife->draw_in=1;
                        $repack_outlife->save();

                       }
                    if (is_null($Batches->outlife_seconds)) {
                        $updated_outlife_seconds    =  (int) $Batches->outlife * 86400 - (int) substr_replace($row['remaining_days_seconds'], "", -3);
                    } else {
                        $updated_outlife_seconds    =  (int) $Batches->outlife_seconds - (int) substr_replace($row['remaining_days_seconds'], "", -3);
                    }

                    $dt1                     =  new DateTime("@0");
                    $dt2                     =  new DateTime("@$updated_outlife_seconds");
                    $updated_outlife         =  $dt1->diff($dt2)->format('%a days, %h hours, %i minutes and %s seconds');
                    $current_outlife_expiry  =  CarbonImmutable::now()->add($updated_outlife_seconds, 'second')->toDateTimeLocalString();

                    $Batches->update([
                        'outlife_seconds' => $updated_outlife_seconds,
                        'outlife'         => $updated_outlife,
                    ]);
                    $history = materialProductHistory::where(['barcode_number' => $Batches->barcode_number, 'DrawStatus' => 'Draw OUT'])->first();
                    // $newHistory =  $history->replicate();
                    // $newHistory->DrawStatus = 'Draw IN';
                    // $newHistory->RemainingOutlifeOfParent = $updated_outlife;
                    // $newHistory->save();
 MaterialProductHistory($Batches, 'Repack_Outlife_Draw_IN'); 
                    RepackOutlife::find($row['id'])->update([
                        'draw_in'                 => 1,
                        'draw_in_time_stamp'      => $row['draw_in']['time_stamp'],
                        'draw_out'                => 1,
                        'draw_out_time_stamp'     => $row['draw_out']['time_stamp'],
                        'updated_outlife'         => $updated_outlife,
                        'updated_outlife_seconds' => $updated_outlife_seconds,
                        'current_outlife_expiry'  => $current_outlife_expiry,
                        'remain_days'             => $row['remaining_days'],
                        'remaining_days_seconds'  => $row['remaining_days_seconds'],
                        'draw_out_last_access'    => auth_user()->alias_name,
                    ]);
                }

               
                return response()->json([
                    "status"    => true,
                    "message"   => "Success !"
                ]);
            }
        }
    }
    public function export_repack_outlife($id)
    {
        $excel_file_name = "Repack-Outlife-" . date("Y-M-d  h-i-s A") . ".xlsx";
        return Excel::download(new RepackOutlifeExport($id), $excel_file_name);
    }
    public function get_repack_outlife_out_date($id)
    {  $batch_repack=RepackOutlife::find($id);
       $repack=RepackOutlife::where('batch_id',$batch_repack->batch_id)->where('draw_in',0)->where('draw_out_time_stamp',Null)->where('id','!=',$id)->get();
       if(count($repack)>0){
         return response()->json([
            "status"  => true,
            "data"=>$repack[0]->draw_in_time_stamp,
            "message" => ""
        ]);
       }else{
         return response()->json([
            "status"  => true,
            "data"=>$batch_repack->draw_in_time_stamp,
            "message" => ""
         ]);
       }

    }
    
    
}
