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
        $fillable   = [];
        $fillable["user_id"] = (int) auth_user()->id;
        foreach ($inputs as $column => $row) {
            if ($column === 'access') {
                $fillable[$column] = json_encode($row);

            } else {
                $fillable[$column] = $row;
            }
        }
        $material_product_fillable = $fillable;
        unset($material_product_fillable['unit_packing_value']);

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

        $batch->update([
            "total_quantity" => $batch->quantity * $material_product->unit_packing_value
        ]);
        if (wizard_mode() == 'create' || wizard_mode() == 'edit') {
            $batch->update(["system_stock"  => $batch->quantity]);
        }

        // $batch                  =   Batches::updateOrCreate(['material_product_id' => $material_product->id], $fillable);
        // RepackOutlife::updateOrCreate(['batch_id' => $batch->id],[
        //     'batch_id'            => $batch->id,
        //     'input_repack_amount' => $batch->unit_packing_value
        // ]);

        $this->storeFiles($request, $batch);

        if (wizard_mode() == 'duplicate' || wizard_mode() == 'create') {
            $request->session()->put('material_product_id', $material_product->id);
            $request->session()->put('batch_id', $batch->id);
        }
        return Flash::success(__('global.inserted'));
    }

    public function storeFiles($request, $batch)
    {
        if ($request->has('coc_coa_mill_cert')) {
            foreach ($request->coc_coa_mill_cert as $key => $files) {
                $newFileName = Storage::put('public', $files);
                $batch->BatchFiles()->updateOrCreate([
                    'batch_id'       => $batch->id,
                    'column_name'    => 'coc_coa_mill_cert',
                    'original_name'  => $files->getClientOriginalName(),
                    'file_name'      => $newFileName,
                    'file_extension' => $files->getClientOriginalExtension(),
                    'file_path'      => asset('storage/app') . '/' . $newFileName,
                ]);
            }

            if ($batch->coc_coa_mill_cert !== null) {
                foreach (json_decode($batch->coc_coa_mill_cert) as $key => $files) {
                    if (Storage::exists($files)) {
                        Storage::delete($files);
                    }
                }
            }
        }
        if ($request->has('iqc_result')) {
            if (Storage::exists($batch->iqc_result)) {
                Storage::delete($batch->iqc_result);
            }
            $iqc_result              =   Storage::put('public', $request->iqc_result);
            $batch->iqc_result   =   $iqc_result;
            $batch->save();
        }
        if ($request->has('sds')) {
            if (Storage::exists($batch->sds)) {
                Storage::delete($batch->sds);
            }
            $sds              =   Storage::put('public', $request->sds);
            $batch->sds   =   $sds;
            $batch->save();
        }
        if ($request->has('extended_qc_result')) {
            if (Storage::exists($batch->extended_qc_result)) {
                Storage::delete($batch->extended_qc_result);
            }
            $extended_qc_result              =   Storage::put('public', $request->extended_qc_result);
            $batch->extended_qc_result   =   $extended_qc_result;
            $batch->save();
        }

        if ($request->has('disposal_certificate')) {
            if (Storage::exists($batch->disposal_certificate)) {
                Storage::delete($batch->disposal_certificate);
            }
            $disposal_certificate              =    Storage::put('public', $request->disposal_certificate);
            $batch->disposal_certificate   =    $disposal_certificate;
            $batch->save();
        }
        if ($request->has('used_for_td_certificate')) {
            if (Storage::exists($batch->used_for_td_certificate)) {
                Storage::delete($batch->used_for_td_certificate);
            }
            $used_for_td_certificate              =    Storage::put('public', $request->used_for_td_certificate);
            $batch->used_for_td_certificate   =    $used_for_td_certificate;
            $batch->save();
        }
    }
}
