<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MaterialProductsRequest;
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
use App\Exports\BulkExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use App\Interfaces\MartialProductRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Models\Batches;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class MaterialProductsController extends Controller
{
    private   $MartialProductRepository;

    public function __construct(
            MartialProductRepositoryInterface $MartialProductRepository,
            SearchRepositoryInterface   $SearchRepositoryRepository
        ) 
    {
        $this->MartialProductRepository     =   $MartialProductRepository;
        $this->SearchRepositoryRepository   =   $SearchRepositoryRepository;
    }

    public function index(Request $request)
    {
        if($request->filters) {
            $material_product       =  MaterialProducts::where('barcode_number', 'LIKE', "%{$request->filters}%")->paginate(5);
            return response(['status' => true, 'data' => $material_product], Response::HTTP_OK);
        }

        if($request->bulk_search) {
           $row         =   (object) $request->bulk_search;
           $result      =   $this->SearchRepositoryRepository->bulkSearch($row);
           if($result)  return response(['status' => true, 'data' => $result], Response::HTTP_OK);
        }

        if($request->save_advanced_search) {
            $row        =   (object) $request->save_advanced_search['advanced_search']; 
            $result     =   $this->SearchRepositoryRepository->StoreBulkSearch($row, $request);
            if($result) return response(['status' => true,  'message' => trans('response.create')], Response::HTTP_CREATED);
        }

        if($request->advanced_search) {
            $row         =   (object) $request->advanced_search;
            $result      =   $this->SearchRepositoryRepository->advanced_search($row);
            if($result)  return response(['status' => true, 'data' => $result], Response::HTTP_OK);  
        }

        if($request->sort_by) {
            $sort_by = (object) $request->sort_by;
            $material_product       =  MaterialProducts::orderBy($sort_by->col_name, $sort_by->order_type)->paginate(5);
            return response(['status' => true, 'data' => $material_product], Response::HTTP_OK);
        }

        $material_product       =   MaterialProducts::with('Batches')->latest()->paginate(5); 
        
        return response(['status' => true, 'data' => $material_product], Response::HTTP_OK);
    }

    public function advanced_search(Request $request)
    {
        if($request->advanced_search) {
            
            $row = (object) $request->advanced_search;
            
            $material_product = MaterialProducts::select("*")
                                                ->when($row->af_logsheet_id, function ($q) use ($row)  {
                                                    $q->where('in_house_product_logsheet_id', 'LIKE', '%' . $row->af_logsheet_id .'%');
                                                })
                                                ->when($row->af_supplier, function ($q) use ($row)  {
                                                    $q->Where('supplier' , $row->af_supplier);
                                                })
                                                ->paginate(2);

            return response(['status' => true, 'data' => $material_product], Response::HTTP_OK);
        }
    }

    public function my_search_history()
    {
        $data = SaveMySearch::where('user_id', Sentinel::getUser()->id)->get();
        return response(['status' => true, 'data' => $data], Response::HTTP_OK);
    }

    public function import_excel(Request $request)
    {
        $request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
        ]);
        
        Excel::import(new BulkImport, $request->file('select_file'));

        Flash::success(__('global.imported')); 
        return back();
    }
    public function list_index()
    {
        $storage_room_db        =   StorageRoom::all();
        $departments_db         =   Departments::all();
        $statutory_body_db      =   StatutoryBody::all();
        $house_type_db          =   HouseTypes::all();
        $unit_packing_size_db   =   PackingSizeData::all();
        $owners                 =   User::all();
        return view('crm.material-products.list', compact('owners','storage_room_db','departments_db','statutory_body_db','house_type_db','unit_packing_size_db'));  
    }

    public function change_product_category(Request $request)
    {
        $request->session()->put('category_type', $request->type);
         
        return response(['status' => true, 'message' => trans('Category to be changed !')], Response::HTTP_OK);
    }

    public function wizardFormView(Request $request, $type=null ,$wizard_mode=null, $id=null, $batch_id=null)
    {

        if(Route::is('create.material-product'))    $request->session()->put('wizard_mode', 'create');
       
        if($request->route('wizard_mode') == 'edit') $request->session()->put('wizard_mode', 'edit');

        if($request->route('wizard_mode') == 'duplicate') {
            $request->session()->put('wizard_mode', 'duplicate');
            $duplication        =   Batches::find($batch_id)->toArray();
            $duplication_batch  =   Batches::updateOrCreate(["id" => batch_id()],$duplication);
            $request->session()->put('material_product_id', $id);
            $request->session()->put('batch_id', $duplication_batch->id);
        }
 
        $material_product       =  MaterialProducts::find(material_product() ?? $id);
        $batch                  =  Batches::find(batch_id() ?? $batch_id);
        $batch_id               =  $batch->id ?? null;
        $category_selection_db  =  MasterCategories::pluck('name','id');
        $statutory_body_db      =  StatutoryBody::pluck('name','id');
        $unit_packing_size_db   =  PackingSizeData::pluck('name','id');
        $storage_room_db        =  StorageRoom::pluck('name','id');
        $house_type_db          =  HouseTypes::pluck('name','id');
        $departments_db         =  Departments::pluck('name','id');
        $iqc_status             =  [1 => "Pass", 0 => "Fail"];
        $department             =  Departments::get();

        $owners_list            =  User::pluck("alias_name", 'id');
        $owners = [];

        foreach ($owners_list as $key => $value) {
            $owners[$value] = $value;
        }
        if($type == 'form-one') {
            if(wizard_mode() == 'create')    $view = 'crm.material-products.wizard.mandatory-one';
            if(wizard_mode() == 'edit')      $view = 'crm.material-products.edit-wizard.mandatory-one';
            if(wizard_mode() == 'duplicate') $view = 'crm.material-products.duplicate-wizard.mandatory-one';
            $params = ['category_selection_db','statutory_body_db','unit_packing_size_db','material_product','batch_id','batch'];
        }
        if($type == 'form-two') { 
            $staff_db = []; foreach($department as $data) {
                $staff_department = User::where('department', $data->id)->get();
                $user_group = [];
                foreach($staff_department as $user) {
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

            if(wizard_mode() == 'create')    $view  = 'crm.material-products.wizard.mandatory-two';
            if(wizard_mode() == 'edit')      $view  = 'crm.material-products.edit-wizard.mandatory-two';
            if(wizard_mode() == 'duplicate') $view  = 'crm.material-products.duplicate-wizard.mandatory-two';
            $params = ['material_product_dropdown','staff_by_department','staff_db','department','owners','iqc_status','storage_room_db','material_product','batch_id','batch','house_type_db','departments_db'];
        }

        if($type == 'form-three') { 
            if(wizard_mode() == 'create')    $view  = 'crm.material-products.wizard.non-mandatory';
            if(wizard_mode() == 'edit')      $view  = 'crm.material-products.edit-wizard.non-mandatory';
            if(wizard_mode() == 'duplicate') $view  = 'crm.material-products.duplicate-wizard.non-mandatory';
            $params = ['material_product','batch','batch_id'];
        }
        if($type == 'form-four') { 
            if(wizard_mode() == 'create')    $view = 'crm.material-products.wizard.other-fields';
            if(wizard_mode() == 'edit')      $view = 'crm.material-products.edit-wizard.other-fields';
            if(wizard_mode() == 'duplicate') $view = 'crm.material-products.duplicate-wizard.other-fields';
            $params = ['material_product','batch','batch_id'];
        }
        return view($view, compact($params));
    }

    public function storeWizardForm(Request $request, $type, $wizard_mode=null, $id=null, $batch_id=null)
    {
        
        $result =   $this->MartialProductRepository->save_material_product(
            material_product() ?? $id, 
            batch_id() ?? $batch_id,
            $request
        );
        
        if($type == 'form-one')   $view  = 'form-two';
        if($type == 'form-two')   $view  = 'form-three';
        if($type == 'form-three') $view  = 'form-four';
        if($type == 'form-four') {
            forget_session(); return redirect()->route('list-material-products');
        }
        
        if($result) {
            if(wizard_mode() == 'create')     return redirect()->route('create.material-product',['type' => $view]);
            if(wizard_mode() == 'edit')       return redirect()->route('edit_or_duplicate.material-product', [ "wizard_mode"=> 'edit',"type" => $view , "id" => material_product() ?? $id , batch_id() ?? $batch_id]);
            if(wizard_mode() == 'duplicate')  return redirect()->route('edit_or_duplicate.material-product', [ "wizard_mode"=> 'duplicate',"type" => $view , "id" => material_product() ?? $id , batch_id() ?? $batch_id]);
        }
    } 

    public function destroy($id) 
    {
        $data   =   MaterialProducts::find($id);
 
        // foreach($data->Batches as $row) {
        //     if(Storage::exists($row->sds_mill_cert_document)){
        //         Storage::delete($row->sds_mill_cert_document);
        //     }
        //     if(Storage::exists($row->coc_coa_mill_cert_document)){
        //         Storage::delete($row->coc_coa_mill_cert_document);
        //     }
        //     if(Storage::exists($row->iqc_result)){
        //         Storage::delete($row->iqc_result);
        //     }
        //     if(Storage::exists($row->upload_disposal_certificate)){
        //         Storage::delete($row->upload_disposal_certificate);
        //     }
        //     if(Storage::exists($row->extended_qc_result)){
        //         Storage::delete($row->extended_qc_result);
        //     }
        //     $row->delete();
        // }
         
        $data->delete();

        return response(['status' => true,  'message' => trans('response.delete')], Response::HTTP_OK);
    }
}