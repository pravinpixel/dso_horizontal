<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Category selection</label>
        <div class="col-8">
            {!! Form::select('category_selection', $category_selection_db , $material_product->category_selection ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div> 
</div> 
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Item Description</label>
        <div class="col-8">
            {!! Form::number('item_description', $material_product->item_description ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">In-house Product Logsheet ID</label>
        <div class="col-8">
            {!! Form::number('in_house_product_logsheet_id', $material_product->in_house_product_logsheet_id?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Brand <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('brand', $material_product->brand?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Supplier <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('supplier', $material_product->supplier?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Unit Packing size <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('unit_packing_size', $unit_packing_size_db , $material_product->unit_packing_size?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --'])  !!}
        </div>
    </div>
</div> 
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Quantity  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::number('quantity', $material_product->quantity?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Batch #   <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('batch', $material_product->batch?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Serial #   <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('serial', $material_product->serial?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">PO Number  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::text('po_number', $material_product->po_number?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required']) !!}
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
            {!! Form::select('euc_material', $category_selection_db , $material_product->euc_material?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --','required'])  !!}
        </div>
    </div>
</div>