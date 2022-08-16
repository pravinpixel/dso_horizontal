<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Interfaces\MartialProductRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function __construct(
        DsoRepositoryInterface $dsoRepositoryInterface
    ) {
        $this->dsoRepository            = $dsoRepositoryInterface;
    }
    public function threshold_index()
    {
        $page_name  =  "THRESHOLD_QTY";
        $view       =  "crm.notification.threshold-qty";
        return  $this->dsoRepository->renderPage($page_name, $view);
    } 
    public function change_read_status($id)
    {
        $batch = Batches::find($id);
        $batch->is_read = $batch->is_read == 0 ? 1 : 0;
        $batch->save();

        return response()->json([
            'status'  => 200,
            'message' => 'Success'
        ]);
    }
    public function notification_count()
    {
        $data = Batches::where('is_read',0)->get();

        foreach ($data as $key => $row) {
            $row['material_product'] = MaterialProducts::find($row->material_product_id);
        }
        
        return response()->json([
            'status' => 200,
            'data'   => $data,
            'count'  => count($data),
        ]);
    }
    public function near_expiry_expired()
    {
        $data        = Batches::latest()->get();
        $near_expiry = [];
        $expired     = [];
        $failed_iqc  = [];

        foreach ($data as $key => $row) {
            $now            = Carbon::now();
            $date_of_expiry = Carbon::parse($row->date_of_expiry);
            if ($now >= $date_of_expiry) {
                $expired[] = $row;
            } else {
                $near_expiry[] = $row;
            }
            if($row->iqc_status == 1) {
                $failed_iqc[] = $row;
            }
        }
        // dd($near_expiry);
        // dd($expired);
        // dd($failed_iqc);
        return view('crm.notification.near-expiry-expired');
    }
}