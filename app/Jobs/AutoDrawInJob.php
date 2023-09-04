<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Models\Batches;
use App\Models\materialProductHistory;
use App\Models\RepackOutlife;
use Carbon\Carbon;
use DateTime;
class AutoDrawInJob implements ShouldQueue
{
    use IsMonitored;
    public function handle()
    {
        $Batches = Batches::with("RepackOutlife")->get();
        $status = true;
        foreach($Batches as $batch) {
            foreach($batch->RepackOutlife as $outlife) {
                if($outlife->draw_in == 0 && $outlife->draw_out == 1) { //$outlife->draw_in == 0 && $outlife->draw_out == 1
                    $time1     = new DateTime($outlife->created_at);
                    $time2     = new DateTime();
                    $time_diff = $time1->diff($time2);
                    if(($time_diff->h.".".$time_diff->i >= env('AUTO_DRAW_TIMING') )|| $status) {
                        $auto_draw_date       = Carbon::parse($outlife->updated_at)->addHours(8)->addMinutes(30);
                        $auto_draw_difference = dateDifferStr(new DateTime($outlife->updated_at), new DateTime($auto_draw_date));
                        
                        $draw_out_date_strToTime = strtotime($outlife->updated_at);
                        $draw_in_date_strToTime  = strtotime($auto_draw_date);
                        $remaining_days_seconds  = abs($draw_out_date_strToTime-$draw_in_date_strToTime);

                        if (is_null($batch->outlife_seconds)) {
                            $updated_outlife_seconds    =  (int) $batch->outlife * 86400 - (int) substr_replace($remaining_days_seconds, "", -3);
                        } else {
                            $updated_outlife_seconds    =  (int) $batch->outlife_seconds - (int) substr_replace($remaining_days_seconds, "", -3);
                        }
        
                        $updated_outlife  = dateDifferStr(new DateTime("@0"),new DateTime("@$updated_outlife_seconds"));
                   
                        $current_outlife_expiry  =  Carbon::parse($auto_draw_date)->add($updated_outlife_seconds, 'second')->toDateTimeString();

                        if ($batch->unit_packing_value != 0) {
                            RepackOutlife::create([
                                'batch_id'            => $batch->id,
                                'input_repack_amount' => $outlife->remain_amount,
                                'total_quantity'      => $outlife->total_quantity
                            ]);
                        }
                        $outlife->update([
                            'draw_in'                 => 1,
                            'draw_out'                => 1,
                            'draw_out_time_stamp'     => $auto_draw_date->format("F jS, Y, g:i:s a"),
                            'remain_days'             => $auto_draw_difference,
                            'remaining_days_seconds'  => $remaining_days_seconds,
                            'current_date_time'       => $auto_draw_date->toDateTimeLocalString(),
                            'updated_outlife'         => $updated_outlife,
                            'updated_outlife_seconds' => $updated_outlife_seconds,
                            'current_outlife_expiry'  => $current_outlife_expiry,
                        ]);
                        $batch->update([
                            'outlife_seconds'   => $updated_outlife_seconds,
                            'updated_outlife'   => $updated_outlife
                        ]); 
                        $history = materialProductHistory::where(['barcode_number' => $batch->barcode_number, 'DrawStatus' => 'Draw OUT'])->first();
                        $newHistory =  $history->replicate();
                        $newHistory->DrawStatus = 'AUTO_DRAW_IN';
                        $newHistory->RemainingOutlifeOfParent = $updated_outlife;
                        $newHistory->save();
                    }
                }
            }
        }
    }
}
// $auto_draw = Carbon::parse($outlife->updated_at)->addHours(6)->addMinutes(30);