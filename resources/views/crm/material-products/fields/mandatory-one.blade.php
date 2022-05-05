<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Category selection <sup class="text-danger">*</sup></label>
        <div class="col-8">
            @if ($edit_mode == false)
                <select ng-model="category_product_type" ng-change="change_product_type()" class="form-select" >
                    <option value=""> {{ category_type() ==  'material' ? 'Material' : 'In-house Products'}}</option>
                    <option value="material">Material</option>
                    <option value="in_house">In-house Products</option>
                </select>
                @else
                <select disabled class="form-select">
                    <option value="material">Material</option>
                </select>
            @endif 
        </div>
    </div>
</div> 
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Item Description <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('item_description', $material_product->item_description ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required' , in_house_type() ]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Brand <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('brand', $batch->brand?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Supplier <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('supplier', $batch->supplier?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Unit of Measure <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('unit_of_measure', $unit_packing_size_db , $material_product->unit_of_measure ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --'])  !!}
        </div>
    </div>
</div> 
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Unit Packing value <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::number('unit_packing_value', $material_product->unit_packing_value?? null, ['class' =>'form-control form-control-sm', 'placeholder' => 'Type here...'])  !!}
        </div>
    </div>
</div> 
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Quantity  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::number('quantity', $batch->quantity?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required', 'min'=> 1]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Batch #   <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('batch', $batch->batch?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Serial #   <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('serial', $batch->serial?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">PO Number  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('po_number', $batch->po_number?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required', in_house_type()]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Statutory body  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('statutory_body', $statutory_body_db , $material_product->statutory_body?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --','required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">EUC material  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('euc_material', ["No", "Yes"] , $material_product->euc_material?? null, ['class' =>'form-select form-select-sm' ,'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Require bulk volume tracking<sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('require_bulk_volume_tracking', ["No", "Yes"] , $material_product->require_bulk_volume_tracking ?? null, ['class' =>'form-select form-select-sm','required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Require outlife tracking<sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('require_outlife_tracking', ["No", "Yes"] , $material_product->require_outlife_tracking ?? null, ['class' =>'form-select form-select-sm','required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Outlife<sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::number('outlife',  $batch->outlife ?? null, ['class' =>'form-control form-control-sm','required', 'placeholder' => 'Type here...'])  !!}
        </div>
    </div>
</div>