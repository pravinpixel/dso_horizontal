<div class="row m-0">
    <div class="col-lg-6"> 
        <div class="row m-0 y-center my-2"> 
            <label for="" class="col-4">Category selection <sup class="text-danger">*</sup></label>
            <div class="col-8">
                @if (wizard_mode() == 'create' || session()->get('edit_mode') == 'parent')
                    <input type="hidden" value="{{ category_type() ?? $material_product->category_selection ?? null}}" name="category_selection">
                    <select required onchange="change_product_type()" class="form-select" id="category_type" {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."category_selection.status") }}>
                        <option value=""> -- select --</option>
                        <option {{ category_type() ==  'material' ? 'selected' : null }} {{ $material_product->category_selection ?? null ==  'material' ? 'selected' : null }} value="material">Material</option>
                        <option {{ category_type() ==  'in_house' ? 'selected' : null }} {{ $material_product->category_selection ?? null ==  'in_house' ? 'selected' : null }} value="in_house">In-House Products</option> 
                    </select>
                        @else
                    <input type="text" disabled value="{{ $material_product->category_selection }}" class="form-control form-select-sm">
                @endif
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Item Description <sup class="text-danger">*</sup></label>
            <div class="col-8"> 
                {!! Form::text('item_description', $material_product->item_description ?? null , [
                        'class'         => 'form-control form-select-sm', 
                        'placeholder'   => 'Type here...', 
                        'list'          => 'item_descriptions', 
                        "onkeyup"       => "wordMatchSuggest(this)",
                        'required',
                        config(is_disable(category_type() ?? $material_product->category_selection ?? null)."item_description.status")
                    ])
                !!}
                <datalist id="item_descriptions"></datalist>
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Brand <sup class="text-danger">*</sup></label>
            <div class="col-8">
                @php
                    $brand = category_type() ==  'material' ? null : "In-House"
                @endphp
                {!! Form::text('brand', $batch->brand ?? $brand, 
                    ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required',
                    'list'          => 'brands', 
                    "onkeyup"       => "wordMatchSuggest(this)",
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."brand.status")
                ]) !!}
                <datalist id="brands"></datalist>
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Supplier <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text('supplier', $batch->supplier ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."supplier.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Unit of Measure <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('unit_of_measure', $unit_packing_size_db , $material_product->unit_of_measure ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --', 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."unit_of_measure.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Unit Packing value <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::number('unit_packing_value', $material_product->unit_packing_value?? null, ['class' =>'form-control form-control-sm', 'placeholder' => 'Type here...','required', "step" => "0.01",
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."unit_packing_value.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Quantity  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::number('quantity', $batch->quantity?? null, ['class' => 'form-control form-select-sm three-digits', 'placeholder' => 'Type here...','required', 'min'=> 1, "step" => "any",
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."quantity.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Unique Barcode </label>
            <div class="col-8">
                {!! Form::number('barcode_number', wizard_mode() === 'duplicate' ? generateBarcode(category_type() ?? $material_product->category_selection ?? null) : $batch->barcode_number ?? generateBarcode(category_type() ?? $material_product->category_selection ?? null), ['class' => 'form-control form-select-sm', 'readonly']) !!} 
            </div>
        </div>
    </div> 
    <div class="col-lg-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Batch #   <sup class="text-danger">*</sup></label>
            <div class="col-8"> 
                {!! Form::text('batch', $batch->batch ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."batch.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Serial # <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text('serial', 
                    is_reset('serial', $batch->serial ?? null , category_type() ?? $material_product->category_selection ?? null), 
                    ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."serial.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">PO Number  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text('po_number', is_reset('po_number', $batch->po_number ?? null , category_type() ?? $material_product->category_selection ?? null) , ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...','required',
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."po_number.status"),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Statutory body  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('statutory_body', $statutory_body_db , $batch->statutory_body ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --','required',
                    config(is_disable(category_type() ?? $batch->category_selection ?? null)."statutory_body.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">EUC material  <sup class="text-danger">*</sup></label>
            <div class="col-8"> 
                {!! Form::select('euc_material', ["No", "Yes"] , $batch->euc_material?? null, ['class' =>'form-select form-select-sm' ,'required',
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."euc_material.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Require bulk volume tracking<sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('require_bulk_volume_tracking', ["No", "Yes"] , $batch->require_bulk_volume_tracking ?? null, ['class' =>'form-select form-select-sm','required',
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."require_bulk_volume_tracking.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Require outlife tracking<sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('require_outlife_tracking', ["No", "Yes"] , $batch->require_outlife_tracking ?? null, ['class' =>'form-select form-select-sm','required','id'=>'require_outlife_tracking_status_input', 'onchange' => 'outlifeChange()',
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."require_outlife_tracking.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2" >
            <label for="" class="col-4">Outlife<sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::number('outlife',  $batch->outlife ?? null, ['class' =>'form-control form-control-sm','required', 'placeholder' => 'Type here...','required',"id"=>"outlife_input",
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."outlife.status")
                ])  !!}
            </div>
        </div>
    </div> 
</div> 