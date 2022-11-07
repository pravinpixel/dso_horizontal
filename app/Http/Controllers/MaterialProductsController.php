<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Models\Masters\MasterCategories;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use App\Models\Masters\PackingSizeData;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\Departments;
use App\Models\MaterialProducts;
use App\Models\User;
use App\Models\SaveMySearch;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use App\Imports\BulkImport;
use App\Interfaces\DsoRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\MartialProductRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Models\Batches;
use App\Models\BatchFiles;
use App\Models\BatchTracker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Storage;


class MaterialProductsController extends Controller
{
    private   $MartialProductRepository;

    public function __construct(
        MartialProductRepositoryInterface $MartialProductRepository,
        SearchRepositoryInterface   $SearchRepository,
        DsoRepositoryInterface $dsoRepositoryInterface
    ) {
        $this->MartialProductRepository = $MartialProductRepository;
        $this->SearchRepository         = $SearchRepository;
        $this->dsoRepository            = $dsoRepositoryInterface;
    }

    public function index(Request $request)
    {
        if ($request->filters) {
            $material_product      =   $this->SearchRepository->barCodeSearch($request);
            return response(['status' => true, 'data' => $material_product], Response::HTTP_OK);
        } 
        
        if ($request->save_advanced_search) {
            $row        =   (object) $request->save_advanced_search['advanced_search'];
            $result     =   $this->SearchRepository->storeBulkSearch($row, $request);
            if ($result) return response(['status' => true,  'message' => trans('response.create')], Response::HTTP_CREATED);
        }

        if ($request->advanced_search) {
            $row         =   (object) $request->advanced_search;
            $result      =   $this->SearchRepository->advanced_search($row);
            if ($result) return response(['status' => true, 'data' => $result], Response::HTTP_OK);
        }

        if ($request->sort_by) {
            $sort_by    =   (object) $request->sort_by;
            $result     =   $this->SearchRepository->sortingOrder($sort_by);
            return response(['status' => true, 'data' => $result], Response::HTTP_OK);
        }
       
        $material_product_data   =   MaterialProducts::with([
            'Batches', 
            'Batches.RepackOutlife',
            'Batches.HousingType', 
            'Batches.Department', 
            'UnitOfMeasure',
            'Batches.StorageArea',
            'Batches.StatutoryBody',
        ])->get();
        
        $material_product = $this->dsoRepository->renderTableData($material_product_data); 

        return response(['status'   =>  true, 'data' => $material_product ], Response::HTTP_OK);
    }

    public function advanced_search(Request $request)
    {
        if ($request->advanced_search) {

            $row = (object) $request->advanced_search;

            $material_product = MaterialProducts::select("*")
                ->when($row->af_logsheet_id, function ($q) use ($row) {
                    $q->where('in_house_product_logsheet_id', 'LIKE', '%' . $row->af_logsheet_id . '%');
                })
                ->when($row->af_supplier, function ($q) use ($row) {
                    $q->Where('supplier', $row->af_supplier);
                })
                ->paginate(config('app.paginate'));

            return response(['status' => true, 'data' => $material_product], Response::HTTP_OK);
        }
    }

    public function my_search_history()
    {
        $data  = User::with('SaveMySearch')->where('id', auth_user()->id)->first();

        $history = [];
        foreach ($data->SaveMySearch as $row) {
            $history[] =  [
                "id"            => $row->id,
                "search_title"  => $row->search_title,
                "search_data"   => json_decode($row->search_data),
                "created_at"    => date("F j, Y, g:i a", strtotime($row->created_at)),
            ];
        }
        return response(['status' => true, 'data' => $history], Response::HTTP_OK);
    }

    public function save_search_history(Request $request)
    { 
        $request->validate([
            'search_title' => 'required|unique:save_my_searches',
        ]); 
        $data = SaveMySearch::create([
            'user_id'      => auth_user()->id,
            'search_title' => $request->search_title,
            'search_data'  => json_encode($request->data),
        ]);
        LogActivity::log($data->id);
        return response(['status' => true, "message" => "Saved Success !"], Response::HTTP_OK);
    }
    public function delete_search_history($id)
    {
        SaveMySearch::findOrFail($id)->delete(); 
        LogActivity::log($id);
        return response(['status' => true, "message" => "Delete Success !"], Response::HTTP_OK);
    }

    public function import_excel(Request $request)
    {
        $request->validate([
            'select_file' => 'required|max:10000',
        ]);
 
        try {
            $array = Excel::toArray(new BulkImport, $request->file('select_file'));
            foreach ($array[0] as $key => $row) {
                if (!is_null($row['category_selection'])) {
                    try {
                        $unit_of_measure = PackingSizeData::updateOrCreate(['name' => $row['unit_of_measure'] ],[
                            'name' => $row['unit_of_measure']
                        ]);
                        $material  = MaterialProducts::create([
                            'category_selection'              => $row['category_selection'] == 'Material' ? 'material' : 'in_house',
                            'item_description'                => $row['item_description'] ?? null,
                            'unit_of_measure'                 => $unit_of_measure->id,
                            'unit_packing_value'              => $row['unit_packing_value'] ?? null,
                            'alert_threshold_qty_upper_limit' => $row['alert_threshold_qty_upper_limit'] ?? null,
                            'alert_threshold_qty_lower_limit' => $row['alert_threshold_qty_lower_limit'] ?? null,
                            'alert_before_expiry'             => $row['alert_before_expiry'] ?? null,
                            'material_quantity'               => $row['quantity'],
                            'material_total_quantity'         => $row['quantity'] * $row['unit_packing_value'],
                            'is_draft' => true
                        ]);
    
                        LogActivity::log($material->id);
                        
                        $statutory_body = StatutoryBody::updateOrCreate(['name' => $row['statutory_body'] ],[
                            'name' => $row['statutory_body']
                        ]);
                        $storage_area = StorageRoom::updateOrCreate(['name' => $row['storage_area'] ],[
                            'name' => $row['storage_area']
                        ]);
                        $housing_type = HouseTypes::updateOrCreate(['name' => $row['housing_type'] ],[
                            'name' => $row['housing_type']
                        ]);
                        $department = Departments::updateOrCreate(['name' => $row['department'] ],[
                            'name' => $row['department']
                        ]);
       
                        $batch = $material->Batches()->create([
                            'is_draft'                     => 1,
                            'barcode_number'               => generateBarcode($material->category_selection),
                            'brand'                        => $row['brand'] ?? null,
                            'supplier'                     => $row['supplier'] ?? null,
                            'unit_packing_value'           => $row['unit_packing_value'] ?? null,
                            'quantity'                     => $row['quantity'] ?? null,
                            'total_quantity'               => $row['quantity'] * $row['unit_packing_value'],
                            'batch'                        => $row['batch'] ?? null,
                            'serial'                       => $row['serial'] ?? null,
                            'po_number'                    => $row['po_number'] ?? null,
                            'statutory_body'               => $statutory_body->id,
                            'euc_material'                 => $row['euc_material'] ?? null,
                            'require_bulk_volume_tracking' => $row['require_bulk_volume_tracking'] ?? null,
                            'require_outlife_tracking'     => $row['require_outlife_tracking'] ?? null,
                            'outlife'                      => $row['outlife'] ?? null,
                            'storage_area'                 => $storage_area->id,
                            'housing_type'                 => $housing_type->id,
                            'housing'                      => $row['housing'] == '-' ? 'nil' : $row['housing'],
                            'owner_one'                    => $row['owner_one'] ?? null,
                            'owner_two'                    => $row['owner_two'] ?? null,
                            'department'                   => $department->id,
                            'access'                       => $row['access'] ?? null,
                            'date_in'                      => strExcelDate($row['date_in']),
                            'date_of_expiry'               => strExcelDate($row['date_of_expiry']),
                            'iqc_status'                   => $row['iqc_status'] == 'Pass' ? 1 : 0,
                            'iqc_result'                   => $row['iqc_result'] ?? null,
                            'sds'                          => $row['sds'] ?? null,
                            'cas'                          => $row['cas'] ?? null,
                            'fm_1202'                      => $row['fm_1202'] ?? null,
                            'project_name'                 => $row['project_name'] ?? null,
                            'material_product_type'        => $row['material_product_type'] ?? null,
                            'date_of_manufacture'          => strExcelDate($row['date_of_manufacture']),
                            'date_of_shipment'             => strExcelDate($row['date_of_shipment']),
                            'cost_per_unit'                => $row['cost_per_unit'] ?? null,
                            'remarks'                      => $row['remarks'] ?? null,
                            'no_of_extension'              => $row['no_of_extension'] ?? 0
                        ]);
                        Flash::success(__('global.imported'));
                    } catch (\Throwable $th) {
                        Log::info($th->getMessage());
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::info("Invalid Action !");
        }
        return back();
    }

    public function list_index()
    {
        $page_name  =  "MATERIAL_SEARCH_OR_ADD";
        $view       =  "crm.material-products.list";
        return  $this->dsoRepository->renderPage($page_name, $view);
    }
 
    public function change_product_category(Request $request)
    {
        $request->session()->put('category_type', $request->type);
        return response(['status' => true, 'message' => trans('Category to be changed !')], Response::HTTP_OK);
    }

    public function wizardFormView(Request $request, $type = null, $wizard_mode = null, $id = null, $batch_id = null , $is_parent = null)
    {

        if($is_parent == 1) {
            $request->session()->put('edit_mode', 'parent');
        } else {
            $request->session()->put('edit_mode', 'batch');
        }
       
        if (Route::is('create.material-product')) $request->session()->put('wizard_mode', 'create');

        if ($request->route('wizard_mode') == 'edit') $request->session()->put('wizard_mode', 'edit');

        if ($request->route('wizard_mode') == 'duplicate') { 
            $request->session()->put('wizard_mode', 'duplicate');  
        }

        $material_product       =  MaterialProducts::find(material_product() ?? $id);
        $batch                  =  Batches::find(batch_id() ?? $batch_id);
        $batch_id               =  $batch->id ?? null;
        $category_selection_db  =  MasterCategories::pluck('name', 'id');
        $statutory_body_db      =  StatutoryBody::pluck('name', 'id');
        $unit_packing_size_db   =  PackingSizeData::pluck('name', 'id');
        $storage_room_db        =  StorageRoom::pluck('name', 'id');
        $house_type_db          =  HouseTypes::pluck('name', 'id');
        $departments_db         =  Departments::pluck('name', 'id');
        $iqc_status             =  [1 => "Pass", 0 => "Fail"];
        $department             =  Departments::get();
        $owners_list            =  User::pluck("alias_name", 'id');
        $owners = [];

        foreach ($owners_list as $key => $value) {
            $owners[$value] = $value;
        }
        if ($material_product != null) {
            foreach ($material_product->toArray() as $key => $value) {
                $material_product->{$key} = is_reset(
                    $key,
                    $value,
                    $material_product->category_selection ?? category_type()
                );
            }
            foreach ($batch->toArray() as $key => $value) {
                $batch->{$key} = is_reset(
                    $key,
                    $value,
                    $material_product->category_selection ?? category_type()
                );
            }
        }

        if ($type == 'form-one') {
            if (wizard_mode() == 'create')       $view   =   'crm.material-products.wizard.mandatory-one';
            if (wizard_mode() == 'edit')         $view   =   'crm.material-products.edit-wizard.mandatory-one';
            if (wizard_mode() == 'duplicate')    $view   =   'crm.material-products.duplicate-wizard.mandatory-one';
            $params = ['category_selection_db', 'statutory_body_db', 'unit_packing_size_db', 'material_product', 'batch_id', 'batch'];
        }

        if ($type == 'form-two') {
            $staff_db = [];
            foreach ($department as $data) {
                $staff_department = User::where('department', $data->id)->get();
                $user_group = [];
                foreach ($staff_department as $user) {
                    $user_group[] = $user;
                }
                $staff_db[] = [
                    "id"   =>  $data->id ?? "-",
                    "name" =>  $data->name ?? "-",
                    "list" =>  $user_group,
                ];
            }
            $staff_db_decode           =    json_encode($staff_db);
            $staff_by_department       =    $staff_db;
            $material_product_dropdown =    json_decode($batch->access ?? null);

            if (wizard_mode() == 'create')    $view  = 'crm.material-products.wizard.mandatory-two';
            if (wizard_mode() == 'edit')      $view  = 'crm.material-products.edit-wizard.mandatory-two';
            if (wizard_mode() == 'duplicate') $view  = 'crm.material-products.duplicate-wizard.mandatory-two';
            $params = ['material_product_dropdown', 'staff_by_department', 'staff_db', 'department', 'owners', 'iqc_status', 'storage_room_db', 'material_product', 'batch_id', 'batch', 'house_type_db', 'departments_db'];
        }

        if ($type == 'form-three') {
            if (wizard_mode() == 'create')    $view  = 'crm.material-products.wizard.non-mandatory';
            if (wizard_mode() == 'edit')      $view  = 'crm.material-products.edit-wizard.non-mandatory';
            if (wizard_mode() == 'duplicate') $view  = 'crm.material-products.duplicate-wizard.non-mandatory';
            $params = ['material_product', 'batch', 'batch_id'];
        }
        if ($type == 'form-four') {
            if (wizard_mode() == 'create')    $view = 'crm.material-products.wizard.other-fields';
            if (wizard_mode() == 'edit')      $view = 'crm.material-products.edit-wizard.other-fields';
            if (wizard_mode() == 'duplicate') $view = 'crm.material-products.duplicate-wizard.other-fields';
            $params = ['material_product', 'batch', 'batch_id'];
        }
        return view($view, compact($params));
    }
    public function storeWizardForm(Request $request, $type, $wizard_mode = null, $id = null, $batch_id = null)
    {
        $result = $this->MartialProductRepository->save_material_product(
            material_product() ?? $id,
            batch_id() ?? $batch_id,
            $request
        ); 
        
        if ($type == 'form-one') {
            $current_batch = Batches::find(batch_id() ?? $batch_id); 
            if($current_batch->require_bulk_volume_tracking == 0 && $current_batch->require_outlife_tracking == 0) {
                $withdrawal_type = 'DIRECT_DEDUCT';
            } elseif($current_batch->require_bulk_volume_tracking == 1 && $current_batch->require_outlife_tracking == 0) {
                $withdrawal_type = 'DEDUCT_TRACK_USAGE';
            } elseif($current_batch->require_bulk_volume_tracking == 0 && $current_batch->require_outlife_tracking == 1) {
                $withdrawal_type = 'DEDUCT_TRACK_OUTLIFE';
            }  elseif($current_batch->require_bulk_volume_tracking == 1 && $current_batch->require_outlife_tracking == 1) {
                $withdrawal_type = 'DEDUCT_TRACK_OUTLIFE';
            }
 
            $current_batch->update([
                'withdrawal_type' => $withdrawal_type
            ]);

            if(wizard_mode() == 'edit') {
                LogActivity::log(material_product() ?? $id);
            }
            
            if (wizard_mode() == 'create') {
                LogActivity::log(material_product() ?? $id);
                $request->session()->put('form-one', 'completed');
            }
            $view  = 'form-two';
        }
        if ($type == 'form-two') {
            if (wizard_mode() == 'create') {
                $request->session()->put('form-two', 'completed');
            }
            $view  = 'form-three';
        }
        if ($type == 'form-three') {
            if (wizard_mode() == 'create') {
                $request->session()->put('form-three', 'completed');
            }
            $view  = 'form-four';
            $this->getQuantityColor( batch_id() ?? $batch_id);
        }
        if ($type == 'form-four') {
            $this_batch_id =  batch_id() ?? $batch_id;
            forgot_session();  
            if($request->is_print == 1) { 
                return redirect()->route('barcode.listing', ["id" => $this_batch_id]);
            } else {
                return redirect()->route('list-material-products');
            }
        }

        if ($result) {
            if (wizard_mode() == 'create')     return redirect()->route('create.material-product', ['type' => $view]);
            if (wizard_mode() == 'edit')       return redirect()->route('edit_or_duplicate.material-product', ["wizard_mode" => 'edit', "type" => $view, "id" => material_product() ?? $id, batch_id() ?? $batch_id , "is_parent" =>  is_parent()]);
            if (wizard_mode() == 'duplicate')  return redirect()->route('edit_or_duplicate.material-product', ["wizard_mode" => 'duplicate', "type" => $view, "id" => material_product() ?? $id, batch_id() ?? $batch_id]);
        }
    }

    public function getQuantityColor($id)
    {
        $batch       = Batches::with('BatchMaterialProduct')->find($id);
        $quantity    = $batch->quantity;
        $lower_limit = $batch->BatchMaterialProduct->alert_threshold_qty_lower_limit;
        $upper_limit = $batch->BatchMaterialProduct->alert_threshold_qty_upper_limit;

        if($quantity < $lower_limit) {
            $quantityColor = 'RED';
        } else {
            if($lower_limit < ($quantity) &&  ($upper_limit) > ($quantity)) {
                $quantityColor = 'AMBER';
            } else {
                if($quantity > $upper_limit) {
                    $quantityColor = 'GREEN';
                } else {
                    $quantityColor = 'AMBER';
                }
            }
        }
        Log::info($quantityColor);
        return $batch->update([
            'quantity_color' => $quantityColor
        ]);
    }

    public function show_batch($id)
    {
        return Batches::findOrFail($id);
    }
    public function viewBatch($id)
    {
        $data = Batches::findOrFail($id);
        return response()->json([
            "category_selection"           => $data->BatchMaterialProduct->category_selection == 'in_house' ? 'In-house Product' : 'Material',
            "item_description"             => $data->BatchMaterialProduct->item_description,
            "brand"                        => $data->brand,
            "supplier"                     => $data->supplier,
            "unit_packing_value"           => $data->BatchMaterialProduct->unit_packing_value,
            "quantity"                     => $data->quantity,
            "batch"                        => $data->batch,
            "serial"                       => $data->serial,
            "po_number"                    => $data->po_number,
            "statutory_body"               => $data->StatutoryBody->name,
            "euc_material"                 => $data->euc_material == 1 ? "Yes" : $data->euc_material == 0 ? "No" : "-",
            "require_bulk_volume_tracking" => $data->require_bulk_volume_tracking == 1 ? "Yes" : $data->require_bulk_volume_tracking == 0 ? "No" : "-",
            "require_outlife_tracking"     => $data->require_outlife_tracking == 1 ? "Yes" : $data->require_outlife_tracking == 0 ? "No" : "-" .$data->outlife ?? "0",
            "storage_area"                 => $data->StorageArea !== null ? $data->StorageArea->name : '-',
            "housing"                      => $data->housing_type !== null ? $data->HousingType->name : '-'."/".$data->housing,
            "owners"                       => $data->owner_one."/".$data->owner_two,
            "department"                   => $data->Department->name,
            "access"                       => $data->access,
            "date_in"                      => $data->date_in,
            "date_of_expiry"               => $data->date_of_expiry,
            "sds"                          => $data->sds,
            "date_of_expiry"               => $data->date_of_expiry,
            "coc_coa_mill_cert"            => $data->coc_files ?? null,
            "iqc_status"                   => $data->iqc_status == 0 ? "Fail" : "Pass",
            "iqc_result"                   => $data->iqc_result,
            "cas"                          => $data->cas,
            "fm_1202"                      => $data->fm_1202 == 'on' ? "Yes" : "No",
            "project_name"                 => $data->project_name,
            "material_product_type"        => $data->material_product_type,
            "date_of_manufacture"          => $data->date_of_manufacture,
            "date_of_shipment"             => $data->date_of_shipment,
            "cost_per_unit"                => $data->cost_per_unit,
            "remarks"                      => $data->remarks,
            "extended_expiry"              => $data->extended_expiry ?? ' - ',
            "extended_qc_status"           => $data->extended_qc_status ?? ' - ',
            "extended_qc_status"           => $data->extended_qc_status ?? ' - ',
            "extended_qc_result"           => $data->extended_qc_result ?? ' - ',
            "disposal_certificate"         => $data->disposal_certificate ?? ' - ',
            "used_for_td_expt_only"        => $data->used_for_td_expt_only == 1 ? 'Yes' : $data->used_for_td_expt_only == 0 ? "No" : "-",
        ]);
    }
    public function view_batch($id)
    {
        $data       =   Batches::findOrFail($id);
        $user_name  =   [];

        if ($data->access !== null || $data->access != 'Default') {
            foreach (json_decode($data->access ?? '[]') as $users) {
                $user_name[]  = User::find($users)->alias_name;
            }
        }
        return [
            "access"          => $user_name ?? null,
            "department"      => Departments::find($data->department)->name ?? null,
            "statutory_body"  => StatutoryBody::find($data->statutory_body)->name ?? null,
            "storage_area"    => StorageRoom::find($data->storage_area)->name ?? null,
            "housing_type"    => HouseTypes::find($data->housing_type)->name ?? null,
        ];
    }
    public function destroy($id)
    { 
        MaterialProducts::find($id)->delete();
        LogActivity::log($id);
        return response(['status' => true,  'message' => trans('response.delete')], Response::HTTP_OK);
    }
    public function batch_destroy($id)
    { 
        if(BatchTracker::where('from_batch_id', $id)->count() == 0) {
            $data   =   Batches::find($id); 
            if (Storage::exists($data->sds_mill_cert_document)) {
                Storage::delete($data->sds_mill_cert_document);
            }
            if (Storage::exists($data->coc_coa_mill_cert_document)) {
                Storage::delete($data->coc_coa_mill_cert_document);
            }
            if (Storage::exists($data->iqc_result)) {
                Storage::delete($data->iqc_result);
            }
            if (Storage::exists($data->upload_disposal_certificate)) {
                Storage::delete($data->upload_disposal_certificate);
            }
            if (Storage::exists($data->extended_qc_result)) {
                Storage::delete($data->extended_qc_result);
            }
            BatchRestore($id);
            $data->delete();
            LogActivity::log($id);
            return response(['status' => true,  'message' => trans('response.delete')], Response::HTTP_OK);
        } else {
            return response(['status' => true,  'message' => "You Can't Delete Batch!"], Response::HTTP_OK);
        }
    }
    public function suggestion(Request $request)
    {
        try {
            $data =  MaterialProducts::where($request->name, 'LIKE','%'.$request->value.'%')->pluck($request->name);
        } catch (\Throwable $th) {
            $data =  Batches::where($request->name, 'LIKE','%'.$request->value.'%')->pluck($request->name);
        }
        return response(['status' => true,  'data' => collect($data)->unique()], Response::HTTP_OK);
    }
    public function duplicate_batch($id)
    {
        $current_batch                  =   Batches::find($id);
        $created_batch                  =   $current_batch->replicate();
        $created_batch->created_at      =   Carbon::now();
        $created_batch->is_draft        =   1;
        $batch_parent_category          =   MaterialProducts::find($created_batch->material_product_id)->category_selection;
        $created_batch->barcode_number  =   generateBarcode($batch_parent_category); 
        
        foreach($created_batch->toArray() as $column => $value) {
            $rest = config('is_disable.duplicate.'.$batch_parent_category.'.'.$column.'.reset');
            if($rest == 1 || $rest == true) {
                $created_batch->$column = NULL;
            }
        }
        
        $created_batch->save(); 
        request()->session()->put('material_product_id', $created_batch->material_product_id);
        request()->session()->put('batch_id', $created_batch->id);
        LogActivity::log($created_batch->id);
        return response()->json([
            "status"                =>  true,
            "wizard_mode"           =>  "duplicate",
            "batch_id"              =>  $created_batch->id,
            "material_product_id"   =>  $created_batch->material_product_id,
        ]);
    } 
    public function delete_file($id)
    {
        $file = BatchFiles::findOrFail($id);
        Storage::delete($file->file_name);
        $file->delete();
        return response()->json([
            "Message" => "success"
        ]);
    }
}