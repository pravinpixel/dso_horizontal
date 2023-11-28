<div class="row m-0">
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">No.of extension</label>
            <div class="col-8">
                {!! Form::number('no_of_extension', $batch->no_of_extension ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_expiry.status')]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Extended QC status</label>
            <div class="col-8">
                {!! Form::select('extended_qc_status', ['0' => 'Fail', '1' => 'Pass'], $batch->extended_qc_status ?? null, ['class' => 'form-select form-select-sm', 'placeholder' => '-- Select --', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_qc_status.status')]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Extended QC result</label>
            <div class="col-8 ">
                {!! Form::file('extended_qc_result', ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_qc_result.status')]) !!}
                {!! getBatchFile($batch->BatchFiles, 'extended_qc_result') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Disposal certificate</label>
            <div class="col-8">
                {!! Form::file('disposal_certificate', ['class' => 'form-control form-control-sm ', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'disposal_certificate.status')]) !!}
                {!! getBatchFile($batch->BatchFiles, 'disposal_certificate') !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Used for TD/Expt only</label>
            <div class="col-8">
                <select class="form-select form-select-sm" name="used_for_td_expt_only"  disabled  >
                    <option {{ $batch->coc_coa_mill_cert_status == 'off' ? "selected" : null }} value="0"> No </option>
                    <option {{ $batch->coc_coa_mill_cert_status == 'on' ? "selected" : null }} value="1"> Yes </option>
                </select>
                {!! getBatchFile($batch->BatchFiles, 'used_for_td_certificate') !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Date Of Disposal</label>
            <div class="col-8">
               <input type="text" class="form-control form-select-sm" name="dod" value="{{date('d/m/Y',strtotime($batch->disposed_after))}}" readonly>
               
            </div>
        </div>
    </div>
</div>
<div id="hidden_input"></div>