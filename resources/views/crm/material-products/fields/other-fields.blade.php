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
                {!! Form::select('extended_qc_status', ['FAIL' => 'Fail', 'PASS' => 'Pass'], $batch->extended_qc_status ?? null, ['class' => 'form-select form-select-sm', 'placeholder' => '-- Select --', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_qc_status.status')]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Extended QC result</label>
            <div class="col-8 ">
                {!! Form::file('extended_qc_result', ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...', config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'extended_qc_result.status')]) !!}
                @if ($batch->extended_qc_result)
                    <button onclick="download('{{ $batch->id }}','extended_qc_result')" class="badge bg-warning rounded-pill text-dark ms-1 border-0" type="button" >
                        <i class="fa fa-download me-1"></i>Download
                    </button>
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
                    <button onclick="download('{{ $batch->id }}','disposal_certificate')" class="badge bg-warning rounded-pill text-dark ms-1 border-0" type="button" >
                        <i class="fa fa-download me-1"></i>Download
                    </button>
                @endif
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Used for TD/Expt only</label>
            <div class="col-8"> 
                <select class="form-select form-select-sm" name="used_for_td_expt_only"  disabled  >
                    <option {{ $batch->coc_coa_mill_cert_status == 'off' ? "selected" : null }} value="0"> No </option>
                    <option {{ $batch->coc_coa_mill_cert_status == 'on' ? "selected" : null }} value="1"> Yes </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div id="hidden_input"></div>