<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\NEFNotification;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
class NotificationController extends Controller
{
    public $dsoRepository;
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
        $data = MaterialProducts::with([
            'Batches',
            'Batches.RepackOutlife',
            'Batches.HousingType',
            'Batches.Department',
            'UnitOfMeasure',
            'Batches.StorageArea',
            'Batches.StatutoryBody',
            'Batches.BatchMaterialProduct'
        ])->where(['is_read' => 0, 'is_draft' => 0,])->orderBy('updated_at')->get();

        $material_products =  $this->dsoRepository->renderTableData($data, [
            "response"  => "JSON",
            "page_name" => "THRESHOLD_QTY"
        ]);
        $material_products_data =  $this->dsoRepository->renderTableData($data, [
            "response"  => "JSON",
            "page_name" => "MATERIAL_SEARCH_OR_ADD"
        ]);
        $notifications = [];
        foreach (['EXPIRY_TABLE','NEAR_EXPIRY_TABLE','FAILED_IQC_TABLE'] as $type) {
            $notifications[$type][] = $this->near_expiry_expired_ajax($type, true);
        }
        NEFNotification::truncate();
        foreach ($notifications as $type => $data) {
            if (count($data)) {
                foreach ($data as $key => $batches) {
                    if(count($batches)) {
                        foreach($batches as $batch) {
                            if ($batch->notification_status == 0) {
                                NEFNotification::updateOrCreate([
                                    'batch_id' => $batch['id'],
                                    'type'     => $type,
                                ]);
                            }
                        }
                    }
                }
            }
        }
        $notification_data = [
            "NEAR_EXPIRY_TABLE" => NEFNotification::where('type', 'NEAR_EXPIRY_TABLE')->get(),
            "EXPIRY_TABLE"      => NEFNotification::where('type', 'EXPIRY_TABLE')->get(),
            "FAILED_IQC_TABLE"  => NEFNotification::where('type', 'FAILED_IQC_TABLE')->get(),
        ]; 
        $view = view('templates.notification-modal', compact('material_products', 'notification_data'));
        return response()->json([
            'status' => 200,
            'view'   => "$view",
            'data'   => $material_products,
            'count'  => (count($material_products)
                + count($notification_data['NEAR_EXPIRY_TABLE'])
                + count($notification_data['EXPIRY_TABLE'])
                + count($notification_data['FAILED_IQC_TABLE'])),
        ]);
    }
    public function near_expiry_expired_index()
    {
        return view('crm.notification.near-expiry-expired');
    }
    public function near_expiry_expired_ajax($type = null, $isTable = null)
    {
        $material_product_data   =   MaterialProducts::with([
            'Batches',
            'Batches.RepackOutlife',
            'Batches.HousingType',
            'Batches.Department',
            'UnitOfMeasure',
            'Batches.StorageArea',
            'Batches.StatutoryBody',
            'Batches.BatchMaterialProduct',
             'Batches.LatestBatchFiles',
        ])->get();
       
        $material_products =  $this->dsoRepository->renderTableData($material_product_data, [
            "response"  => "JSON",
            "page_name" => "NEAR_EXPIRY_EXPIRED"
        ]);
        $notifications = [
            'EXPIRY_TABLE' => [],
            'NEAR_EXPIRY_TABLE' => [],
            'FAILED_IQC_TABLE' => [],
        ];
        foreach ($material_products as $key => $value) {
            foreach ($value['Batches'] as $index => $row) {
                if ($row->date_of_expiry_color === 'text-danger') {
                    $notifications['EXPIRY_TABLE'][] = $row;
                } elseif ($row->date_of_expiry_color === 'text-warning') {
                    $notifications['NEAR_EXPIRY_TABLE'][] = $row;
                } elseif ($row->iqc_status == 0 && $row->quantity != 0) {
                    $notifications['FAILED_IQC_TABLE'][] = $row;
                }
                if ($row['permission'] == 'READ_ONLY') {
                    unset($material_products[$key]['Batches'][$index]);
                }
            }
            if (count($value['Batches']) == 0 || $value['material_quantity_color'] == 'text-success') {
                unset($material_products[$key]);
            }
        }
        $table = $notifications[$type];

        if (!is_null($isTable)) {
            return $table;
        }
        return DataTables::of($table)
            ->addIndexColumn()
            ->addColumn('item_description', function ($table) {
                return $table->BatchMaterialProduct->item_description;
            })
            ->addColumn('batch_serial_po_number', function ($table) {
                return $table->batch . "/" . $table->serial . "/" . $table->po_number;
            })
             ->addColumn('date_of_disposal', function ($table) {
            if(isset($table->disposed_after)){
                 return $table->disposed_after;
               }
            return '';
               
            })
            ->addColumn('owners', function ($table) {
                $owners = "";
                foreach ($table->BatchOwners as $key => $owner) {
                    $owners .=  '
                        <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">
                            ' . $owner->alias_name . '
                        </small>
                    ';
                }
                return $owners;
            })
            // ->addColumn('storage_area', function($table){
            //     return $table->StorageArea->name;
            // })
            // ->addColumn('housing_type', function($table){
            //     return $table->HousingType->name;
            // })
            ->addColumn('iqc_status', function ($table) {
                if ($table->iqc_status) {
                    return '<span class="badge bg-success rounded-pill">PASS</span>';
                } else {
                    return '<span class="badge bg-danger rounded-pill">FAIL</span>';
                }
            })
            ->addColumn('action', function ($table) {
                return '
                    <div class="dropdown">
                        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('disposal', $table->id) . '"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                            <a class="dropdown-item" href="' . route('extend-expiry', $table->id) . '"><i class="bi bi-arrow-up-right-square me-1"></i> Extend expiry</a>
                            <a class="dropdown-item" onclick="viewBatch(' . $table->id . ')"><i class="bi bi-eye-fill me-1"></i>View batch details</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action', 'item_description', 'batch_serial_po_number', 'owners', 'housing_type', 'storage_area', 'iqc_status'])
            ->make(true);
    }

    public function delete_notification($id)
    {
        $row =  NEFNotification::find($id);
        $batch=Batches::find($row->batch_id);
        if($batch){
            $batch->notification_status=1;
            $batch->update();
        }
        $row->delete();
        return response([
            "status" => true
        ]);
    }
}
