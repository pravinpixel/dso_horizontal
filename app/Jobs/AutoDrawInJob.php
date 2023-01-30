<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Models\Batches;
use App\Models\LogSheet;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Illuminate\Support\Facades\Log;

class AutoDrawInJob implements ShouldQueue
{
    use IsMonitored;
    public function handle()
    {
        
        $Batches = Batches::with("RepackOutlife")->get();
        foreach($Batches as $batch) {
            foreach($batch->RepackOutlife as $outlife) {
                if($outlife->draw_in == 0 && $outlife->draw_out == 1) { //$outlife->draw_in == 0 && $outlife->draw_out == 1
                    $time1     = new DateTime($outlife->created_at);
                    $time2     = new DateTime();
                    $time_diff = $time1->diff($time2);
                    if(true) {
                        $auto_draw_date       = Carbon::parse($outlife->updated_at)->addHours(8)->addMinutes(30);
                        $auto_draw_difference = dateDifferStr(new DateTime($outlife->updated_at), new DateTime($auto_draw_date));
                        
                        $draw_out_date_strToTime = strtotime($outlife->updated_at);
                        $draw_in_date_strToTime  = strtotime($auto_draw_date);
                        $remaining_days_seconds  = abs($draw_out_date_strToTime-$draw_in_date_strToTime);
 
                        if($batch->outlife_seconds === null) {
                            $updated_outlife_seconds    =  (int) $batch->outlife * 86400 - (int) $remaining_days_seconds;
                        } else {
                            $updated_outlife_seconds    =  (int) $batch->outlife_seconds - (int) $remaining_days_seconds;
                        }
        
                        $updated_outlife  = dateDifferStr(new DateTime("@0"),new DateTime("@$updated_outlife_seconds"));
                   
                        $current_outlife_expiry  =  Carbon::parse($auto_draw_date)->add($updated_outlife_seconds, 'second')->toDateTimeString();

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
                        MaterialProductHistory($batch,'AUTO_DRAW_IN'); 
                    }
                }
            }
        }
    }
}
// $auto_draw = Carbon::parse($outlife->updated_at)->addHours(6)->addMinutes(30);