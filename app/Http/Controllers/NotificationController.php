<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function __construct(
        DsoRepositoryInterface $dsoRepositoryInterface
    ) {
        $this->dsoRepository  = $dsoRepositoryInterface;
    }
    public function threshold_index()
    {
        $page_name  =  "THRESHOLD_QTY";
        $view       =  "crm.notification.threshold-qty";
        return  $this->dsoRepository->renderPage($page_name, $view);
    }
    public function change_read_status($id)
    {
        $MaterialProducts = MaterialProducts::findOrFail($id);
        $MaterialProducts->is_read = $MaterialProducts->is_read == 0 ? 1 : 0;
        $MaterialProducts->save();
        return response()->json([
            'status'  => 200,
            'message' => 'Success'
        ]);
    }
    public function notification_count()
    {
        $data = MaterialProducts::with('Batches')->where(['is_read' => 0,'is_draft' => 0,])->orderBy('updated_at')->get();

        $MaterialProducts =  $this->dsoRepository->renderTableData($data, [
            "response" => "JSON",
            "page_name" => "THRESHOLD_QTY"
        ]);

        return response()->json([
            'status' => 200,
            'data'   => $MaterialProducts,
            'count'  => count($MaterialProducts),
        ]);
    }
    public function near_expiry_expired_index()
    {
        return view('crm.notification.near-expiry-expired');
    }
    public function near_expiry_expired_ajax($type = null)
    {
        $material_product_data   =   MaterialProducts::with([
            'Batches',
            'Batches.RepackOutlife',
            'Batches.HousingType',
            'Batches.Department',
            'UnitOfMeasure',
            'Batches.StorageArea',
            'Batches.StatutoryBody',
        ])->latest()->get();

        $material_product = $this->dsoRepository->renderTableData($material_product_data,[
            "response" => 'JSON',
            "page_name" => $type
        ]);
        $Batches = [];
        foreach ($material_product as $key => $value) {
            foreach ($value['Batches'] as $key => $row) {
                $Batches[] = $row;
            }
        }
 
        $near_expiry = [];
        $expired     = [];
        $failed_iqc  = [];

        foreach ($Batches as $key => $row) {
            if($row->date_of_expiry_color == 'text-warning') {
                $near_expiry[] = $row;
            }
            if($row->date_of_expiry_color == 'text-danger') {
                $expired[] = $row;
            }
            if($row->iqc_status == 0 && $row->quantity != 0) {
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
            ->addColumn('iqc_status', function($table){
                if ($table->iqc_status) {
                    return '<span class="badge bg-success rounded-pill">PASS</span>';
                } else {
                    return '<span class="badge bg-danger rounded-pill">FAIL</span>';
                }
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
            ->rawColumns(['action','item_description','batch_serial_po_number','owners','housing_type','storage_area','iqc_status'])
        ->make(true);
    }
}
