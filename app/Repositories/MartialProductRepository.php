<?php

namespace App\Repositories;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Interfaces\MartialProductRepositoryInterface;
use App\Models\BarCodeFormat;
use App\Models\MaterialProducts;
use Faker\Provider\Barcode;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Storage;

class MartialProductRepository implements MartialProductRepositoryInterface {

    public function __construct(BarCodeLabelRepositoryInterface $barCodeLabelRepository)    {
        $this->barCodeLabelRepository       =   $barCodeLabelRepository;
    }

    public function save_material_product($material_product_id=null, $batch_id=null, $request) {
         
        $inputs = $request->except([
            '_token',
            'coc_coa_mill_cert',
            'iqc_result',
            'sds',
            'extended_qc_result',
            'disposal_certificate',
        ]);
        

        $fillable   = []; foreach($inputs as $column => $row) $fillable[$column] = $row;
        $material_product   =   MaterialProducts::updateOrCreate(['id' => $material_product_id], $fillable);
        $batch              =   $material_product->Batches()->updateOrCreate(['id' => $batch_id], $fillable);

        // $batch->RepackOutlife()->updateOrCreate(['id' => $batch_id], $fillable);
 
        $this->storeFiles($request, $batch);

        if(wizard_mode() == 'duplicate' || wizard_mode() == 'create')  {
            $this->barCodeLabelRepository->generateBarcode($material_product, $batch);
            $request->session()->put('material_product_id', $material_product->id);
            $request->session()->put('batch_id', $batch->id);
        } 

        // if(wizard_mode() == 'create') { 
        //     $this->barCodeLabelRepository->generateBarcode($material_product, $batch);
        //     $request->session()->put('material_product_id', $material_product->id);
        //     $request->session()->put('batch_id', $batch->id);
        // }

        return Flash::success(__('global.inserted'));
    }
 
    public function storeFiles($request, $batch)
    {
        if($request->has('coc_coa_mill_cert')) {
            if(Storage::exists($batch->coc_coa_mill_cert)){
                Storage::delete($batch->coc_coa_mill_cert);
            }
            $coc_coa_mill_cert              =   $request->file('coc_coa_mill_cert')->store('public/files/coc_coa_mill_cert');
            $batch  ->  coc_coa_mill_cert   =   $coc_coa_mill_cert;
            $batch  ->  save();
        }
        if($request->has('iqc_result')) {
            if(Storage::exists($batch->iqc_result)){
                Storage::delete($batch->iqc_result);
            }
            $iqc_result              =   $request->file('iqc_result')->store('public/files/iqc_result');
            $batch  ->  iqc_result   =   $iqc_result;
            $batch  ->  save();
        }
        if($request->has('sds')) {
            if(Storage::exists($batch->sds)){
                Storage::delete($batch->sds);
            }
            $sds              =   $request->file('sds')->store('public/files/sds');
            $batch  ->  sds   =   $sds;
            $batch  ->  save();
            // dd($batch);
        }
        if($request->has('extended_qc_result')) {
            if(Storage::exists($batch->extended_qc_result)){
                Storage::delete($batch->extended_qc_result);
            }
            $extended_qc_result              =   $request->file('extended_qc_result')->store('public/files/extended_qc_result');
            $batch  ->  extended_qc_result   =   $extended_qc_result;
            $batch  ->  save();
        }

        if($request->has('disposal_certificate')) {
            if(Storage::exists($batch->disposal_certificate)){
                Storage::delete($batch->disposal_certificate);
            }
            $disposal_certificate              =   $request->file('disposal_certificate')->store('public/files/disposal_certificate');
            $batch  ->  disposal_certificate   =   $disposal_certificate;
            $batch  ->  save();
        }
    } 
}