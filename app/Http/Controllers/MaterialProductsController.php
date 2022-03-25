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
use Laracasts\Flash\Flash;

class MaterialProductsController extends Controller
{
    public function form_one_index(Request $request)
    {

        $id                     =   $request->session()->get('material_product_id');
        $material_product       =   MaterialProducts::find($id);        
        $category_selection_db  =   MasterCategories::pluck('name','id');
        $statutory_body_db      =   StatutoryBody::pluck('name','id');
        $unit_packing_size_db   =   PackingSizeData::pluck('name','id');

        return view('crm.material-products.wizard.mandatory-one', compact([
            'category_selection_db',
            'statutory_body_db',
            'unit_packing_size_db',
            'material_product'
        ]));
    }

    public function form_one_store(MaterialProductsRequest $request)
    {   
          
        $material_product = MaterialProducts::updateOrCreate([
            'category_selection'            =>   $request->category_selection,
            'item_description'              =>   $request->item_description,
            'in_house_product_logsheet_id'  =>   $request->in_house_product_logsheet_id,
            'brand'                         =>   $request->brand,
            'supplier'                      =>   $request->supplier,
            'unit_packing_size'             =>   $request->unit_packing_size,
            'quantity'                      =>   $request->quantity,
            'batch'                         =>   $request->batch,
            'serial'                        =>   $request->serial,
            'po_number'                     =>   $request->po_number,
            'statutory_body'                =>   $request->statutory_body,
            'euc_material'                  =>   $request->euc_material,
        ]);
        
        $request->session()->put('material_product_id', $material_product->id);
         
        Flash::success(__('global.inserted'));

        return redirect()->route('mandatory-form-two');
    }

    public function form_two_index(Request $request)
    {
        $id    =  $request->session()->get('material_product_id');
        $material_product  =  MaterialProducts::find($id);

        $storage_room_db    =   StorageRoom::pluck('name','id');
        $house_type_db      =   HouseTypes::pluck('name','id');
        $departments_db     =   Departments::pluck('name','id');
 

        return view('crm.material-products.wizard.mandatory-two', compact([
            'storage_room_db',
            'house_type_db',
            'departments_db',
            'material_product'
        ]));
    }
    public function form_two_store(Request $request)
    {
          
        $id    =  $request->session()->get('material_product_id');
        $data  =  MaterialProducts::find($id);
        
        try {
            
            //  File Upload Process
            if($request->has('sds_mill_cert_document')) {
                $sds_mill_cert_document = $request->file('sds_mill_cert_document')->store('public/files/sds_mill_cert_document');
            }
            if($request->has('coc_coa_mill_cert_document')) {
                $coc_coa_mill_cert_document = $request->file('coc_coa_mill_cert_document')->store('public/files/sds_mill_cert_document');
            }
            if($request->has('iqc_result')) {
                $iqc_result = $request->file('iqc_result')->store('public/files/sds_mill_cert_document');
            }
        
            $data->update([
                'storage_room'                =>  $request->storage_room,
                'house_type'                  =>  $request->house_type,
                'owner_one'                   =>  $request->owner_one,
                'owner_two'                   =>  $request->owner_two,
                'department'                  =>  $request->department,
                'access'                      =>  $request->access,
                'date_in'                     =>  $request->date_in,
                'date_of_expiry'              =>  $request->date_of_expiry,
                'iqc_status'                  =>  $request->iqc_status,
                'sds_mill_cert_document'      =>  $sds_mill_cert_document ?? $request->sds_mill_cert_document_URL,
                'coc_coa_mill_cert_document'  =>  $coc_coa_mill_cert_document ?? $request->coc_coa_mill_cert_document_URL,
                'iqc_result'                  =>  $iqc_result ?? $request->iqc_result_URL,
            ]);

        } catch (\Throwable $th) {
            Flash::success(__('global.something'));;
        }
    
        Flash::success(__('global.inserted'));
        return redirect()->route('mandatory-form-two');
    }
} 