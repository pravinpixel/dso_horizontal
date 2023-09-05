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
        $Batches = Batches::with("DrawInOutlife")->get();
        foreach ($Batches as $batch) {
            if(!empty($batch->DrawInOutlife)) {
                foreach ($batch->DrawInOutlife as $outlife) {
                    if ($this->hasDrawIn($outlife)) {
                        $draw_in_date            = Carbon::parse($outlife->updated_at)->addHours(8)->addMinutes(30);
                        $auto_draw_difference    = dateDifferStr(new DateTime($outlife->updated_at), new DateTime($draw_in_date));
                        $remaining_days_seconds  = abs(strtotime($outlife->updated_at) - strtotime($draw_in_date));
                        $updated_outlife_seconds = (int) $batch->outlife_seconds - (int) substr_replace($remaining_days_seconds, "", -3);
                        $updated_outlife         = dateDifferStr(new DateTime("@$updated_outlife_seconds"), new DateTime("@$remaining_days_seconds"));
                        $current_outlife_expiry  = Carbon::parse($draw_in_date)->add($updated_outlife_seconds, 'second')->toDateTimeString();
                        $this->createNewOutlife($batch, $outlife);
                        $batch->update([
                            'outlife_seconds' => $updated_outlife_seconds,
                            'outlife'         => $updated_outlife,
                        ]);
                        $outlife->update([
                            'draw_in'                 => 1,
                            'draw_out'                => 1,
                            'draw_out_time_stamp'     => $draw_in_date->format("F jS, Y, g:i:s a"),
                            'remain_days'             => $auto_draw_difference,
                            'remaining_days_seconds'  => $remaining_days_seconds,
                            'current_date_time'       => $draw_in_date->toDateTimeLocalString(),
                            'updated_outlife'         => $updated_outlife,
                            'updated_outlife_seconds' => $updated_outlife_seconds,
                            'current_outlife_expiry'  => $current_outlife_expiry,
                        ]);
                        $this->createMaterialProductHistory($batch, $updated_outlife);
                    }
                }
            }
        }
    }

    function hasDrawIn($outlife) {
        $status     = true;
        $created_at = new DateTime($outlife->created_at);
        $now        = new DateTime();
        $time_diff  = $created_at->diff($now);
        if (($time_diff->h . "." . $time_diff->i >= env('AUTO_DRAW_TIMING')) || $status) {
            return true;
        }
        return false;
    }

    function createNewOutlife($batch, $outlife)
    {
        if ($batch->unit_packing_value != 0) {
            RepackOutlife::create([
                'batch_id'            => $batch->id,
                'input_repack_amount' => $outlife->remain_amount,
                'total_quantity'      => $outlife->total_quantity
            ]);
        }
        return true;
    }

    function createMaterialProductHistory($batch, $updated_outlife)
    {
        $history = materialProductHistory::where(['barcode_number' => $batch->barcode_number, 'DrawStatus' => 'Draw OUT'])->first();
        $newHistory =  $history->replicate();
        $newHistory->DrawStatus = 'AUTO_DRAW_IN';
        $newHistory->RemainingOutlifeOfParent = $updated_outlife;
        return  $newHistory->save();
    }
}