<?php

namespace App\Repositories;

use App\Interfaces\MartialProductRepositoryInterface;
use App\Models\BarCodeFormat;
use App\Models\MaterialProducts;
use Faker\Provider\Barcode;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Storage;

class MartialProductRepository implements MartialProductRepositoryInterface {

    public function save_material_product($material_product_id=null, $batch_id=null, $request) {
        $inputs = $request->except([
            '_token',
            'coc_coa_mill_cert',
            'iqc_result',
            'sds',
            'extended_qc_result',
            'disposal_certificate',
        ]);
 
        $fillable   = []; 
        foreach($inputs as $column => $row) {
            $fillable[$column] = $row;
        }
         
        $material_product       =   MaterialProducts::updateOrCreate(['id' => $material_product_id], $fillable);
        $batch                  =   $material_product->Batches()->updateOrCreate(['id' => $batch_id], $fillable); 
        $this->storeFiles($request, $batch);

   
        
        if(wizard_mode() == 'duplicate' || wizard_mode() == 'create')  {
            $request->session()->put('material_product_id', $material_product->id);
            $request->session()->put('batch_id', $batch->id);
        } 
        return Flash::success(__('global.inserted'));
    }
 
    public function storeFiles($request, $batch)
    {
        if($request->has('coc_coa_mill_cert')) {
            if(Storage::exists($batch->coc_coa_mill_cert)){
                Storage::delete($batch->coc_coa_mill_cert);
            }
            $coc_coa_mill_cert              =  storeFiles('coc_coa_mill_cert');
            Log::info( $coc_coa_mill_cert);
            $batch  ->  coc_coa_mill_cert   =   $coc_coa_mill_cert;
            $batch  ->  save();
        }
        if($request->has('iqc_result')) {
            if(Storage::exists($batch->iqc_result)){
                Storage::delete($batch->iqc_result);
            }
            $iqc_result              =   storeFiles('iqc_result');
            $batch  ->  iqc_result   =   $iqc_result;
            $batch  ->  save();
        }
        if($request->has('sds')) {
            if(Storage::exists($batch->sds)){
                Storage::delete($batch->sds);
            }
            $sds              =   storeFiles('sds');
            $batch  ->  sds   =   $sds;
            $batch  ->  save();
            // dd($batch);
        }
        if($request->has('extended_qc_result')) {
            if(Storage::exists($batch->extended_qc_result)){
                Storage::delete($batch->extended_qc_result);
            }
            $extended_qc_result              =   storeFiles('extended_qc_result');
            $batch  ->  extended_qc_result   =   $extended_qc_result;
            $batch  ->  save();
        }

        if($request->has('disposal_certificate')) {
            if(Storage::exists($batch->disposal_certificate)){
                Storage::delete($batch->disposal_certificate);
            }
            $disposal_certificate              =    storeFiles('disposal_certificate');
            $batch  ->  disposal_certificate   =    $disposal_certificate;
            $batch  ->  save();
        }
    } 
}