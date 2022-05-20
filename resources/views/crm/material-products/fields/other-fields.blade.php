<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended expiry</label>
        <div class="col-8">
            {!! Form::date('extended_expiry', $batch->extended_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? $material_product->category_selection ?? null)."extended_expiry.status")]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended QC status</label>
        <div class="col-8">
           {!! Form::select('extended_qc_status', ['Fail','Pass'] , $batch->extended_qc_status ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' ,config(is_disable(category_type() ?? $material_product->category_selection ?? null)."extended_qc_status.status")])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended QC result</label>
        <div class="col-8 ">
            {!! Form::file('extended_qc_result', ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...',config(is_disable(category_type() ?? $material_product->category_selection ?? null)."extended_qc_result.status")]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Disposal certificate</label>
        <div class="col-8"> 
            {!! Form::file('disposal_certificate', ['class' => 'form-control form-control-sm ', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? $material_product->category_selection ?? null)."disposal_certificate.status")]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Used for TD/Expt only</label>
        <div class="col-8">
           {!! Form::select('used_for_td_expt_only', ['No','Yes'] , $batch->used_for_td_expt_only ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' ,config(is_disable(category_type() ?? $material_product->category_selection ?? null)."used_for_td_expt_only.status")])  !!}
        </div>
    </div>
</div>
<div id="hidden_input"></div>