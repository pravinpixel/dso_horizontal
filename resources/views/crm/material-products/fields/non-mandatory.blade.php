<div class="row m-0">
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">SDS</label>
            <div class="col-8 ">
                <div class="d-flex y-center border rounded p-0">
                    {!! Form::file('sds',  ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...', 
                        config(is_disable(category_type() ?? $material_product->category_selection ?? null)."sds.status")
                    ]) !!}
                </div>
                @if ($batch->sds)
                    <a href="{{ storageGet($batch->sds) }}" download="{{ storageGet($batch->sds) }}">
                        <i class="fa fa-download"></i> <small>{{ substr(str_replace('public/files/sds/','' ,$batch->sds),0,20) }}</small>
                    </a>
                @endif
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">CAS#</label>
            <div class="col-8">
                {!! Form::text('cas', $batch->cas ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."cas.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">FM1202 </label>
            <div class="col-8">
                <div class="form-control form-control-sm">                 
                    {!! Form::checkbox('fm_1202', $batch->fm_1202 ?? null , true, ['class' => 'form-check-input me-2',
                        config(is_disable(category_type() ?? $material_product->category_selection ?? null)."fm_1202.status")
                    ]) !!}
                    <small>Yes! Included</small>
                </div>
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Project name</label>
            <div class="col-8">
                {!! Form::text('project_name', $batch->project_name ?? null, [
                    'class' => 'form-control form-select-sm need-word-match', 
                    'placeholder' => 'Type here...', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."project_name.status")
                ]) !!} 
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Material/Product type</label>
            <div class="col-8">
                {!! Form::text('material_product_type', $batch->material_product_type ?? null, [
                    'class' => 'form-control form-select-sm need-word-match', 
                    'placeholder' => 'Type here...',  
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."material_product_type.status")
                ]) !!} 
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Alert Threshold Qty <br><small>(Upper limit)</small></label>
            <div class="col-8">
               {!! Form::number('alert_threshold_qty_upper_limit', $material_product->alert_threshold_qty_upper_limit ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...',
                config(is_disable(category_type() ?? $material_product->category_selection ?? null)."alert_threshold_qty_upper_limit.status")
               ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Alert Threshold Qty <br><small>(Lower limit)</small></label>
            <div class="col-8">
            {!! Form::number('alert_threshold_qty_lower_limit', $material_product->alert_threshold_qty_lower_limit ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...',
                config(is_disable(category_type() ?? $material_product->category_selection ?? null)."alert_threshold_qty_lower_limit.status")
            ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Alert before expiry <br><small>(weeks)</small></label>
            <div class="col-8">
            {!! Form::number('alert_before_expiry', $material_product->alert_before_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...',
                config(is_disable(category_type() ?? $material_product->category_selection ?? null)."alert_before_expiry.status")
            ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Date of manufacture</label>
            <div class="col-8">
                {!! Form::date('date_of_manufacture', $batch->date_of_manufacture ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...',
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."date_of_manufacture.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Date of shipment</label>
            <div class="col-8">
                {!! Form::date('date_of_shipment', $batch->date_of_shipment ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...',
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."date_of_shipment.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Cost per unit</label>
            <div class="col-8">
            {!! Form::number('cost_per_unit', $batch->cost_per_unit ?? null, ['class' => 'form-control form-select-sm three-digits', 'placeholder' => 'Type here...',"step" => "0.01",
                config(is_disable(category_type() ?? $material_product->category_selection ?? null)."cost_per_unit.status")
            ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Remarks</label>
            <div class="col-8">
            {!! Form::text('remarks', $batch->remarks ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...',
                config(is_disable(category_type() ?? $material_product->category_selection ?? null)."remarks.status")
            ]) !!}
            </div>
        </div>
    </div>
</div>