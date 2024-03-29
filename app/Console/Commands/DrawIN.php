<?php

namespace App\Console\Commands;

use App\Models\Batches;
use App\Models\LogSheet;
use Carbon\Carbon;
use App\Models\RepackOutlife;
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
        if(count($batch->RepackOutlife)>0){
       $first=RepackOutlife::where('batch_id',$batch->id)->where('draw_in',0)->where('draw_in_disabled',0)->where('draw_out_time_stamp',Null)->first();
     Log::info($first);
                if(isset($first)) {
                    $time1     =Carbon::parse($first->created_at);
                    $time2     = Carbon::now();
                    $time_diff = $time1->diffInHours($time2);
                      //if(true){

                     //Log::info($time_diff);
                   
                if($time_diff >= env('AUTO_DRAW_TIMING')) {
                    Log::info('Success');
                        // if($batch->unit_packing_value != 0) {
                        //     $batch->RepackOutlife()->create([
                        //         'input_repack_amount' => $last['repack_size']
                        //     ]);
                        // }

                        $draw_out_date_strToTime = strtotime($first->created_at);
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

                        $first->update([
                            'draw_in'                 => 1,
                            'draw_out'                => 1,
                            'draw_out_time_stamp'     => now()->format("F jS, Y, g:i:s a"),
                            'remain_days'             => dateDifferStr(Carbon::parse($first->created_at), Carbon::now()),
                            'remaining_days_seconds'  => $remaining_days_seconds,
                            'current_date_time'       => Carbon::now()->toDateTimeLocalString(),
                            'updated_outlife'         => dateDifferStr(Carbon::parse("@0"),Carbon::parse("@$updated_outlife_seconds")),
                            'updated_outlife_seconds' => $updated_outlife_seconds,
                            'current_outlife_expiry'  => $current_outlife_expiry,
                        ]);
               $repacks=RepackOutlife::where('batch_id',$batch->id)->where('draw_in',0)->get();
               foreach($repacks as $repack_data){
                        $repack_outlife=RepackOutlife::find($repack_data->id);
                        $repack_outlife->draw_in=1;
                        $repack_outlife->draw_in_disabled=1;
                        $repack_outlife->save();

                }
                        MaterialProductHistory($batch,'AUTO_DRAW_IN');
                     Log::info("Draw IN Success !");  
                }
            }
        }     
      }
    }
}
