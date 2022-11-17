<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\ElseIf_;
use Yajra\DataTables\Facades\DataTables;

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
        $data = Batches::where('is_read', 0)->where('quantity_color',"!=",'GREEN')->get(); 
 
        foreach ($data as $key => $row) {
            $row['material_product'] = MaterialProducts::find($row->material_product_id);
        }
        
        return response()->json([
            'status' => 200,
            'data'   => $data,
            'count'  => count($data),
        ]);
    }
    public function near_expiry_expired_index()
    {
        return view('crm.notification.near-expiry-expired');
    }
    public function near_expiry_expired_ajax($type = null)
    {
        $data        = Batches::with(['BatchOwners','BatchMaterialProduct','StorageArea','HousingType'])->where('is_draft',0)->latest()->get();
        $near_expiry = [];
        $expired     = [];
        $failed_iqc  = [];

        foreach ($data as $key => $row) {
            Log::info($row->is_draft);
            $now            = Carbon::now();
            $date_of_expiry = Carbon::parse($row->date_of_expiry);
            if ($now >= $date_of_expiry) {
                $expired[] = $row;
            } elseif($row->iqc_status != "1") {
                $near_expiry[] = $row;
            }
            if($row->iqc_status == 0) {
                $failed_iqc[] = $row;
            }
        }
 
        if($type == 'NEAR_EXPIRY_TABLE') { 
            $table = $near_expiry;
        } elseif($type == 'EXPIRY_TABLE') {
            $table = $expired;
        } elseif($type == 'FAILED_IQC_TABLE') {
            $table = $failed_iqc;
        }
        
        return DataTables::of($table)
            ->addIndexColumn()
            ->addColumn('item_description', function($table){
                return $table->BatchMaterialProduct->item_description;
            })
            ->addColumn('batch_serial_po_number', function($table){
                return $table->batch."/".$table->serial."/".$table->po_number;
            })
            ->addColumn('owners', function($table){
                $owners = "";
                foreach($table->BatchOwners as $key => $owner)  {
                    $owners .=  '
                        <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">
                            '.$owner->alias_name.'
                        </small> 
                    ';
                } 
                return $owners;
            })
            ->addColumn('storage_area', function($table){
                return $table->StorageArea->name;
            })
            ->addColumn('housing_type', function($table){
                return $table->HousingType->name;
            })
            ->addColumn('date_of_expiry', function($table){
                return SetDateFormat($table->date_of_expiry);
            })
            ->addColumn('action', function($table){
                return '
                    <div class="dropdown">
                        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a> 
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.route('disposal',$table->id).'"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                            <a class="dropdown-item" href="'.route('extend-expiry',$table->id).'"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
                            <a class="dropdown-item" onclick="viewBatch('.$table->id.')"><i class="bi bi-eye-fill me-1"></i>View Batch details</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action','item_description','batch_serial_po_number','owners','housing_type','storage_area'])
        ->make(true);
    }
}