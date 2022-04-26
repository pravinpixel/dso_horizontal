
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">CAS#</label>
        <div class="col-8">
            {!! Form::text('cas', $material_product->cas ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">FM1202 </label>
        <div class="col-8">
            <div class="form-control form-control-sm">                 
                {!! Form::checkbox('fm_1202', $material_product->fm_1202 ?? null , true, ['class' => 'form-check-input me-2','required']) !!}
                <small>Yes! Included</small>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Project name</label>
        <div class="col-8">
            {!! Form::text('project_name', $material_product->project_name ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Material/Product type</label>
        <div class="col-8">
            {!! Form::text('project_type', $material_product->project_type ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended expiry</label>
        <div class="col-8">
            {!! Form::text('extended_expiry', $material_product->extended_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required', in_house_type()]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended QC status</label>
        <div class="col-8">
           {!! Form::select('extended_qc_status', $extended_qc_status , $material_product->extended_qc_status ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required',in_house_type()])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended QC result</label>
        <div class="col-8 ">
            <div class="d-flex y-center border rounded p-0">
                {!! Form::hidden('extended_qc_result_URL' , $material_product->extended_qc_result ?? null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...', in_house_type()]) !!}
                {!! Form::file('extended_qc_result', ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...']) !!}
                <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Upload disposal certificate</label>
        <div class="col-8">
            {!! Form::hidden('upload_disposal_certificate_URL' , $material_product->upload_disposal_certificate ?? null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...',]) !!}
            {!! Form::file('upload_disposal_certificate', ['class' => 'form-control form-control-sm ', 'placeholder' => 'Type here...', in_house_type()]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert Threshold Qty for new <i class="ms-1 text-warning dot-sm bi bi-circle-fill"></i></label>
        <div class="col-8">
           {!! Form::number('alert_threshold_qty_for_new', $material_product->alert_threshold_qty_for_new ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert before expiry (in terms of weeks) for new <i class="ms-1 text-warning dot-sm bi bi-circle-fill"></i></label>
        <div class="col-8">
           {!! Form::number('alert_before_expiry', $material_product->alert_before_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert Threshold Qty for new <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></label>
        <div class="col-8">
           {!! Form::number('alert_threshold_qty_for_new_', $material_product->alert_threshold_qty_for_new ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert before expiry (in terms of weeks) for new <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></label>
        <div class="col-8">
           {!! Form::number('alert_before_expiry_', $material_product->alert_before_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Date of manufacture</label>
        <div class="col-8">
            {!! Form::date('date_of_manufacture', $material_product->date_of_manufacture ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>

<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Date of shipment</label>
        <div class="col-8">
            {!! Form::date('date_of_shipment', $material_product->date_of_shipment ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Cost per unit</label>
        <div class="col-8">
           {!! Form::number('cost_per_unit', $material_product->cost_per_unit ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Remarks</label>
        <div class="col-8">
           {!! Form::text('remarks', $material_product->remarks ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div id="hidden_input"></div>