<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">SDS<sup class="text-danger">*</sup></label>
        <div class="col-8 ">
            <div class="d-flex y-center border rounded p-0">
                {!! Form::file('sds',  ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...']) !!}
            </div>
        </div>
    </div>
</div> 
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
            {!! Form::text('material_product_type', $material_product->material_product_type ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>

<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert Threshold Qty (Upper limit)</label>
        <div class="col-8">
           {!! Form::number('alert_threshold_qty_upper_limit', $material_product->alert_threshold_qty_upper_limit ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>

<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert Threshold Qty (Lower limit)</label>
        <div class="col-8">
           {!! Form::number('alert_threshold_qty_lower_limit', $material_product->alert_threshold_qty_lower_limit ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>

<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Alert before expiry (weeks)</label>
        <div class="col-8">
           {!! Form::number('alert_before_expiry', $material_product->alert_before_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
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