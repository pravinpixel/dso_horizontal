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

                    if($time_diff->h.".".$time_diff->i >= env('AUTO_DRAW_TIMING')) {

                        if($batch->unit_packing_value != 0) {
                            $batch->RepackOutlife()->create([
                                'input_repack_amount' => $outlife['repack_size']
                            ]);
                        }

                        $draw_out_date_strToTime = strtotime($outlife->created_at);
                        $draw_in_date_strToTime  = strtotime(now());
                        $remaining_days_seconds  = abs($draw_out_date_strToTime-$draw_in_date_strToTime);

                        if($batch->outlife_seconds === null) {
                            $updated_outlife_seconds    =  (int) $batch->outlife * 86400 - (int) $remaining_days_seconds;
                        } else {
                            $updated_outlife_seconds    =  (int) $batch->outlife_seconds - (int) $remaining_days_seconds;
                        }

                        $current_outlife_expiry  =  CarbonImmutable::now()->add($updated_outlife_seconds, 'second')->toDateTimeString();

                        $batch->update([
                            'outlife_seconds'   => $updated_outlife_seconds,
                            'updated_outlife'   => dateDifferStr(new DateTime("@0"),new DateTime("@$updated_outlife_seconds"))
                        ]);

                        $outlife->update([
                            'draw_in'                 => 1,
                            'draw_out'                => 1,
                            'draw_out_time_stamp'     => now()->format("F jS, Y, g:i:s"),
                            'remain_days'             => dateDifferStr(new DateTime($outlife->created_at), new DateTime()),
                            'remaining_days_seconds'  => $remaining_days_seconds,
                            'current_date_time'       => Carbon::now()->toDateTimeLocalString(),
                            'updated_outlife'         => dateDifferStr(new DateTime("@0"),new DateTime("@$updated_outlife_seconds")),
                            'updated_outlife_seconds' => $updated_outlife_seconds,
                            'current_outlife_expiry'  => $current_outlife_expiry,
                        ]);
                        LogSheet::updateOrCreate([
                            'ip'          => request()->ip(),
                            'agent'       => request()->header('user-agent'),
                            'user_id'     => 0,
                            'user_name'   => 'Server System',
                            'module_name' => 'Batch',
                            'action_type' => 'AUTO DRAW IN	',
                            "module_id"   =>  $batch->id,
                            'remarks'     =>  "New Auto Draw In"
                        ]);
                        Log::info("Draw IN Success !");
                    }
                }
            }
        }
    }
}
