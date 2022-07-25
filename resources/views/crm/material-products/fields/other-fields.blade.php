<div class="row m-0">
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Extended expiry</label>
            <div class="col-8">
                {!! Form::date('extended_expiry', $batch->extended_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_expiry.status')]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Extended QC status</label>
            <div class="col-8">
                {!! Form::select('extended_qc_status', ['Fail', 'Pass'], $batch->extended_qc_status ?? null, ['class' => 'form-select form-select-sm', 'placeholder' => '-- Select --', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_qc_status.status')]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Extended QC result</label>
            <div class="col-8 ">
                {!! Form::file('extended_qc_result', ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_qc_result.status')]) !!}
                @if ($batch->extended_qc_result)
                    <a href="{{ storageGet($batch->extended_qc_result) }}" download="{{ storageGet($batch->extended_qc_result) }}">
                        <i class="fa fa-download"></i> <small>{{ substr(str_replace('public/files/extended_qc_result/','' ,$batch->extended_qc_result),0,20) }}</small>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Disposal certificate</label>
            <div class="col-8">
                {!! Form::file('disposal_certificate', ['class' => 'form-control form-control-sm ', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'disposal_certificate.status')]) !!}
                @if ($batch->disposal_certificate)
                    <a href="{{ storageGet($batch->disposal_certificate) }}" download="{{ storageGet($batch->disposal_certificate) }}">
                        <i class="fa fa-download"></i> <small>{{ substr(str_replace('public/files/disposal_certificate/','' ,$batch->disposal_certificate),0,20) }}</small>
                    </a>
                @endif
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Used for TD/Expt only</label>
            <div class="col-8">
                {{-- {!! Form::select('used_for_td_expt_only', ['No', 'Yes'], $batch->used_for_td_expt_only ?? null, [
                    'class' => 'form-select form-select-sm', 
                    'placeholder' => '-- Select --', 
                    $batch->coc_coa_mill_cert_status != 'on' ? "disabled" : null,
                ]) !!} --}}
                <select class="form-select form-select-sm" name="used_for_td_expt_only" {{ $batch->coc_coa_mill_cert_status != 'on' ? "disabled" : null }}  {{ session()->get('edit_mode') == 'parent' ? "disabled" : null}} >
                    <option {{ $batch->coc_coa_mill_cert_status == 'off' ? "selected" : null }} value="No"> No </option>
                    <option {{ $batch->coc_coa_mill_cert_status == 'on' ? "selected" : null }} value="Yes"> Yes </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div id="hidden_input"></div>