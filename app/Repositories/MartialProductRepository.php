<?php

namespace App\Repositories;

use App\Interfaces\MartialProductRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Storage;

class MartialProductRepository implements MartialProductRepositoryInterface
{

    public function save_material_product($material_product_id = null, $batch_id = null, $request)
    {
        $inputs = $request->except([
            '_token',
            'coc_coa_mill_cert',
            'iqc_result',
            'sds',
            'extended_qc_result',
            'disposal_certificate',
        ]);
        $fillable = [];
        $fillable["user_id"] = (int) auth_user()->id;
        foreach ($inputs as $column => $row) {
            if ($column === 'access') {
                $fillable[$column] = json_encode($row);
            } else {
                $fillable[$column] = $row;
            }
        }
        $material_product_fillable = $fillable;

        if (wizard_mode() === 'edit' && is_null($request->is_parent)) { // EDIT & BATCH ( CHILDED)
            unset($material_product_fillable['unit_packing_value']);
        }
        if (wizard_mode() === 'duplicate') {
            unset($material_product_fillable['unit_packing_value']);
        }
        if (wizard_mode() === 'create' && !is_null($request->is_parent)) { // CREATE & MATRIAL (PARENT)
            unset($fillable['unit_packing_value']);
        }
        if (wizard_mode() === 'edit' && !is_null($request->is_parent)) { // CREATE & MATRIAL (PARENT)
            unset($fillable['unit_packing_value']);
        }

        $material_product       =   MaterialProducts::updateOrCreate(['id' => $material_product_id], $material_product_fillable);
        $batch                  =   $material_product->Batches()->updateOrCreate(['id' => $batch_id], $fillable);
        if (isset($fillable['batch_owners'])) {

            if ($fillable['batch_owners']) {
                $authUser = $fillable['batch_owners'];
                $batch->BatchOwners()->delete();
                foreach ($authUser as $key => $id) {
                    $batch->BatchOwners()->updateOrCreate(["user_id" => (int) $id, "batch_id" => (int) $batch_id], [
                        "user_id"    => (int) $id,
                        "alias_name" => getUserById((int)$id)->alias_name
                    ]);
                }
                $batch->BatchOwners()->updateOrCreate(["user_id" => (int) auth_user()->id, "batch_id"    => (int) $batch_id], [
                    "user_id"    => auth_user()->id,
                    "alias_name" => auth_user()->alias_name
                ]);

                Batches::find($batch_id)->update([
                    'owners' => implode(",", $fillable['batch_owners'])
                ]);
            }
        }
        if ($material_product->quantity_update_status == 1) {
            $MaterialBatch = Batches::find($batch_id);
            $material_product->update([
                "material_quantity"       => $batch->quantity,
                "material_total_quantity" => $batch->quantity *  $MaterialBatch->unit_packing_value,
                "id_draft"                => 0,
                "quantity_update_status"  => 0,
                "unit_packing_value" =>  $MaterialBatch->unit_packing_value
            ]);
        }
        if ($request->has('quantity') && wizard_mode() === 'create'  && !is_null($request->is_parent)) {
            $material_product->update([
                "material_quantity"       => $batch->quantity,
                "material_total_quantity" => $batch->quantity *  $MaterialBatch->unit_packing_value,
                "unit_packing_value"      => $material_product->unit_packing_value
            ]);
        }
        if ($request->has('unit_packing_value') && wizard_mode() === 'edit' && !is_null($request->is_parent)) {
            $material_product->update([
                "material_quantity"  =>  $material_product->material_total_quantity / $request->unit_packing_value,
            ]);
        }
        if ($request->has('quantity') && wizard_mode() === 'create' && is_null($request->is_parent)) {
            $batch->update([
                "total_quantity" => $batch->quantity * $batch->unit_packing_value
            ]);
        }
        if ($request->has('quantity') && wizard_mode() === 'duplicate' && is_null($request->is_parent)) {
            $batch->update([
                "total_quantity" => $batch->quantity * $batch->unit_packing_value
            ]);
        }
        if ($request->has('unit_packing_value') && wizard_mode() === 'edit' && is_null($request->is_parent)) {
            $batch->update([
                "quantity" => $batch->total_quantity / $batch->unit_packing_value
            ]);
        }
        if (wizard_mode() == 'create' || wizard_mode() == 'edit') {
            $batch->update(["system_stock"  => $batch->quantity]);
        }
        if (wizard_mode() == 'duplicate' || wizard_mode() == 'create') {
            updateParentQuantity($material_product);
            $request->session()->put('material_product_id', $material_product->id);
            $request->session()->put('batch_id', $batch->id);
        }
        $result =  $this->storeFiles($request, $batch);
        if($result) {
            return  $result;
        }
        return Flash::success(__('global.inserted'));
    }

    public function storeFiles($request, $batch)
    {
        if ($request->has('coc_coa_mill_cert')) {
            foreach ($request->coc_coa_mill_cert as $key => $files) {
                putBatchFile([
                    "batch_id" => $batch->id,
                    "file"     => $files,
                    "type"     => "coc_coa_mill_cert"
                ]);
            }
        }
        if ($request->has('iqc_result')) {
            putBatchFile([
                "batch_id" => $batch->id,
                "file"     => $request->iqc_result,
                "type"     => "iqc_result"
            ]);
        }
        if ($request->has('sds')) {
            putBatchFile([
                "batch_id" => $batch->id,
                "file"     => $request->sds,
                "type"     => "sds"
            ]);
        }
        if ($request->has('extended_qc_result')) {
            putBatchFile([
                "batch_id" => $batch->id,
                "file"     => $request->extended_qc_result,
                "type"     => "extended_qc_result"
            ]);
        }
        if ($request->has('disposal_certificate')) {
            putBatchFile([
                "batch_id" => $batch->id,
                "file"     => $request->disposal_certificate,
                "type"     => "disposal_certificate"
            ]);
        }
        if ($request->has('used_for_td_certificate')) {
            putBatchFile([
                "batch_id" => $batch->id,
                "file"     => $request->used_for_td_certificate,
                "type"     => "used_for_td_certificate"
            ]);
        }
    }
}
