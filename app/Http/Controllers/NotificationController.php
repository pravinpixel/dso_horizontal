<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Interfaces\MartialProductRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
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
}