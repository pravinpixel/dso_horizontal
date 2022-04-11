<?php

namespace App\Repositories;

use App\Interfaces\MartialProductRepositoryInterface;
use App\Models\MaterialProducts;
use Laracasts\Flash\Flash;
use Storage;
use Illuminate\Http\Response;
 
class MartialProductRepository implements MartialProductRepositoryInterface {
    public function update_form_one($id, $request)
    { 
        return MaterialProducts::find($id)->update([
            'category_selection'            =>   $request->session()->get('category_type'),
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
            'usage_tracking'                =>   $request->usage_tracking,
            'outlife_tracking'              =>   $request->outlife_tracking,
        ]);
    }

    public function update_form_two($id, $request)
    {
        $data  =  MaterialProducts::find($id);
        
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
    }

    public function update_form_three($id, $request)
    {
        $data       =   MaterialProducts::find($id);
         
        try {

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
                'is_draft'                    => $request->is_draft ?? 0
            ]);

            $request->session()->forget('material_product_id');
            Flash::success(__('dso.material_products_created'));
        } catch (\Throwable $th) {
            Flash::error(__('global.something'));
        }
    }
}