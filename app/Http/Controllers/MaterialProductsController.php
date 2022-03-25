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
use Storage;

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
                if(Storage::exists($data->sds_mill_cert_document)){
                    Storage::delete($data->sds_mill_cert_document);
                }
                $sds_mill_cert_document = $request->file('sds_mill_cert_document')->store('public/files/sds_mill_cert_document');
            }
            if($request->has('coc_coa_mill_cert_document')) {
                if(Storage::exists($data->coc_coa_mill_cert_document)){
                    Storage::delete($data->coc_coa_mill_cert_document);
                }
                $coc_coa_mill_cert_document = $request->file('coc_coa_mill_cert_document')->store('public/files/coc_coa_mill_cert_document');
            }
            if($request->has('iqc_result')) {
                if(Storage::exists($data->iqc_result)){
                    Storage::delete($data->iqc_result);
                }
                $iqc_result = $request->file('iqc_result')->store('public/files/iqc_result');
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
        return redirect()->route('non-mandatory-form');
    }

    public function non_mandatory_form_index(Request $request)
    {
        $id                     =   $request->session()->get('material_product_id');
        $material_product       =   MaterialProducts::find($id);
        $extended_qc_status     =   ['Pass','Fail'];

        return view('crm.material-products.wizard.non-mandatory', compact('extended_qc_status','material_product'));  
    }

    public function non_mandatory_form_store(Request $request)
    {
        $id         =   $request->session()->get('material_product_id');
        $data       =   MaterialProducts::find($id); 
 
        try {

            //  File Upload Process
            if($request->has('upload_disposal_certificate')) {
                
                if(Storage::exists($data->upload_disposal_certificate)){
                    Storage::delete($data->upload_disposal_certificate);
                }

                $upload_disposal_certificate = $request->file('upload_disposal_certificate')->store('public/files/upload_disposal_certificate');
            }
            if($request->has('extended_qc_result')) {

                if(Storage::exists($data->extended_qc_result)){
                    Storage::delete($data->extended_qc_result);
                }

                $extended_qc_result = $request->file('extended_qc_result')->store('public/files/extended_qc_result');
            }
        
            $data->update([
                'cas'                         => $request->cas,
                'fm_1202'                     => $request->fm_1202,
                'project_name'                => $request->project_name,
                'project_type'                => $request->project_type,
                'extended_expiry'             => $request->extended_expiry,
                'extended_qc_status'          => $request->extended_qc_status,
                'extended_qc_result'          => $extended_qc_result ?? $request->extended_qc_result_URL,
                'upload_disposal_certificate' => $upload_disposal_certificate ?? $request->upload_disposal_certificate_URL,
                'alert_threshold_qty_for_new' => $request->alert_threshold_qty_for_new,
                'alert_before_expiry'         => $request->alert_before_expiry,
                'date_of_manufacture'         => $request->date_of_manufacture,
                'date_of_shipment'            => $request->date_of_shipment,
                'cost_per_unit'               => $request->cost_per_unit,
                'remarks'                     => $request->remarks,
            ]);

            $request->session()->forget('material_product_id');

        } catch (\Throwable $th) {
            Flash::error(__('global.something'));
        }
        Flash::success(__('dso.material_products_created'));
        return redirect()->route('list-material-products');
    }
}