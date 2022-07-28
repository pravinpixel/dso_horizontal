<?php

namespace App\Http\Controllers;

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
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class MaterialProductsController extends Controller
{
    private   $MartialProductRepository;

    public function __construct(
        MartialProductRepositoryInterface $MartialProductRepository,
        SearchRepositoryInterface   $SearchRepository,
        DsoRepositoryInterface $dsoRepositoryInterface
    ) {
        $this->MartialProductRepository     =   $MartialProductRepository;
        $this->SearchRepository   =   $SearchRepository;
        $this->dsoRepository                =   $dsoRepositoryInterface;
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
       
        $material_product   =   MaterialProducts::with([
            'Batches', 
            'Batches.RepackOutlife',
            'Batches.HousingType', 
            'Batches.Department', 
            'UnitOfMeasure',
            'Batches.StorageArea',
            'Batches.StatutoryBody',
        ])->latest()->paginate(config('app.paginate'));
        return response(['status'   =>  true, 'data' => $material_product], Response::HTTP_OK);
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
        // search_history
        $validated = $request->validate([
            'search_title' => 'required|unique:save_my_searches',
        ]);

        $data   =   User::findOrFail(auth_user()->id);
        $data->SaveMySearch()->create([
            'search_title'  => $request->search_title,
            'search_data'   => json_encode($request->data),
        ]);
        return response(['status' => true, "message" => "Saved Success !"], Response::HTTP_OK);
    }
    public function delete_search_history($id)
    {
        SaveMySearch::findOrFail($id)->delete();
        return response(['status' => true, "message" => "Delete Success !"], Response::HTTP_OK);
    }

    public function import_excel(Request $request)
    {
        $request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $array = Excel::toArray(new BulkImport, $request->file('select_file'));

        foreach ($array[0] as $key => $row) {
            if (!is_null($row['category_selection'])) {
                try {
                    $material  = MaterialProducts::updateOrCreate([
                        'category_selection'                =>   $row['category_selection'],
                        'item_description'                  =>   $row['item_description'],
                        'unit_of_measure'                   =>   $row['unit_of_measure'],
                        'unit_packing_value'                =>   $row['unit_packing_value'],
                        // 'statutory_body'                    =>   $row['statutory_body'],
                        'alert_threshold_qty_upper_limit'   =>   $row['alert_threshold_qty_upper_limit'],
                        'alert_threshold_qty_lower_limit'   =>   $row['alert_threshold_qty_lower_limit'],
                        'alert_before_expiry'               =>   $row['alert_before_expiry_weeks'],
                    ]);
                    $batch = $material->Batches()->updateOrCreate([
                        'brand'                         =>  $row['brand'],
                        'supplier'                      =>  $row['supplier'],
                        'packing_size'                  =>  $row['unit_packing_value'],
                        'quantity'                      =>  $row['quantity'],
                        'batch'                         =>  $row['batch'],
                        'serial'                        =>  $row['serial'],
                        'po_number'                     =>  $row['po_number'],
                        'statutory_body'                =>  $row['statutory_body'],
                        'euc_material'                  =>  $row['euc_material'],
                        'require_bulk_volume_tracking'  =>  $row['require_bulk_volume_tracking'],
                        'require_outlife_tracking'      =>  $row['require_outlife_tracking'],
                        'outlife'                       =>  $row['outlife_days'],
                        'storage_area'                  =>  $row['storage_area'],
                        'housing_type'                  =>  $row['housing_type'],
                        'housing'                       =>  $row['housing'],
                        'owner_one'                     =>  $row['owner_1'],
                        'owner_two'                     =>  $row['owner_2_seplfm'],
                        'department'                    =>  $row['dept'] ,
                        'access'                        =>  $row['access'],
                        'date_in'                       =>  $row['date_in'],
                        'date_of_expiry'                =>  $row['date_of_expiry'],
                        'coc_coa_mill_cert'             =>  $row['coccoamill_cert'],
                        'iqc_status'                    =>  $row['iqc_status_pf'],
                        'iqc_result'                    =>  $row['iqc_result'],
                        'sds'                           =>  $row['sds'],
                        'cas'                           =>  $row['cas'],
                        'fm_1202'                       =>  $row['fm1202'],
                        'project_name'                  =>  $row['project_name'],
                        'material_product_type'         =>  $row['materialproduct_type'],
                        'date_of_manufacture'           =>  $row['date_of_manufacture'],
                        'date_of_shipment'              =>  $row['date_of_shipment'],
                        'cost_per_unit'                 =>  $row['cost_per_unit_sgd'],
                        'remarks'                       =>  $row['remarks'],
                    ]);
                    Flash::success(__('global.imported'));
                } catch (\Throwable $th) {
                    Flash::error($th->getMessage());
                }
            }
        }
        return back();
    }

    public function list_index()
    {
        $page_name  =  "MATERIAL_SEARCH_OR_ADD";
        $view       =  "crm.material-products.list";
        return  $this->dsoRepository->renderPage($page_name, $view);
    }

    public function withdrawal()
    {
        $page_name  =  "MATERIAL_WITHDRAWAL";
        $view       =  "crm.material-products.withdrawal";
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
        $result =   $this->MartialProductRepository->save_material_product(
            material_product() ?? $id,
            batch_id() ?? $batch_id,
            $request
        );
        if ($type == 'form-one') {
            
            $current_batch = Batches::find(batch_id() ?? $batch_id);
            if($current_batch->require_bulk_volume_tracking == 0 || $current_batch->require_outlife_tracking == 0) {
                $withdrawal_type = 'DIRECT_DEDUCT';
            }
            if($current_batch->require_bulk_volume_tracking == 1 || $current_batch->require_outlife_tracking == 0) {
                $withdrawal_type = 'DEDUCT_TRACK_USAGE';
            }
            if($current_batch->require_bulk_volume_tracking == 1 || $current_batch->require_outlife_tracking == 1) {
                $withdrawal_type = 'DEDUCT_TRACK_OUTLIFE';
            }
            
            $current_batch->update([
                'withdrawal_type' => $withdrawal_type
            ]);
           
            if (wizard_mode() == 'create') {
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
        }
        if ($type == 'form-four') {
            $this_batch_id =  batch_id() ?? $batch_id;
            forgot_session();  
            if($request->is_print == 1) { 
                return redirect()->route('print-barcode', ["id" => $this_batch_id]);
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

    public function show_batch($id)
    {
        return Batches::findOrFail($id);
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
        return response(['status' => true,  'message' => trans('response.delete')], Response::HTTP_OK);
    }
    public function batch_destroy($id)
    {
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
        $data->delete();
        return response(['status' => true,  'message' => trans('response.delete')], Response::HTTP_OK);
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
        $batch_parent_category           =   MaterialProducts::find($created_batch->material_product_id)->category_selection;
        $created_batch->barcode_number  =   generateBarcode($batch_parent_category); 
        foreach($created_batch->toArray() as $column => $value) {
            $rest = config('is_disable.duplicate.'.$batch_parent_category.'.'.$column.'.reset');
            if($rest == 1) {
                $created_batch->$column = NULL;
            }
        }
        $created_batch->save(); 
        request()->session()->put('material_product_id', $created_batch->material_product_id);
        request()->session()->put('batch_id', $created_batch->id);
        return response()->json([
            "status"                =>  true,
            "wizard_mode"           =>  "duplicate",
            "batch_id"              =>  $created_batch->id,
            "material_product_id"   =>  $created_batch->material_product_id,
        ]);
    }
}