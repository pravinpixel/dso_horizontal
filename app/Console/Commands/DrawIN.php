<?php

namespace App\Console\Commands;

use App\Models\Batches;
use App\Models\LogSheet;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DrawIN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drawIn:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Draw IN !");
        $Batches = Batches::with("RepackOutlife","BatchOwners")->get();
        foreach($Batches as $batch) {
            foreach($batch->RepackOutlife as $outlife) {
                if(!is_null($outlife->draw_in_time_stamp) && is_null($outlife->draw_out_time_stamp)) {
                    $time1     = new DateTime($outlife->created_at);
                    $time2     = new DateTime();
                    $time_diff = $time1->diff($time2);

                    if(true) {
                     // if($time_diff->h.".".$time_diff->i >= env('AUTO_DRAW_TIMING')) {

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
                        MaterialProductHistory($batch,'AUTO_DRAW_IN');
                        Log::info("Draw IN Success !");
                    }
                }
            }
        }
    }
}
