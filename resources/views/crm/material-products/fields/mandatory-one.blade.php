<div class="row m-0">
    <input type="hidden" name="user_id" value="{{ auth_user()->id }}">
    <div class="col-lg-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Category selection <sup class="text-danger">*</sup></label>
            <div class="col-8">
                @if (wizard_mode() == 'create' || session()->get('edit_mode') == 'parent')
                    <input type="hidden"
                        value="{{ category_type() ?? ($material_product->category_selection ?? null) }}"
                        name="category_selection">
                    @php
                        $category = category_type() ?? ($material_product->category_selection ?? null);
                    @endphp
                    <select required onchange="change_product_type()" class="form-select" id="category_type"
                        {{ config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'category_selection.status') }}>
                        <option value=""> -- Select -- </option>
                        <option {{ $category == 'material' ? 'selected' : '' }} value="material">Material</option>
                        <option {{ $category == 'in_house' ? 'selected' : '' }} value="in_house">In-House Products
                        </option>
                    </select>
                @else
                    <input type="text" disabled value="{{ $material_product->category_selection }}"
                        class="form-control form-select-sm">
                @endif
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Item description <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text('item_description', $material_product->item_description ?? null, [
                    'class' => 'form-control form-select-sm need-word-match',
                    'placeholder' => 'Type here...',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'item_description.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Brand <sup class="text-danger">*</sup></label>
            <div class="col-8">
                @php
                    $category = category_type() ?? ($material_product->category_selection ?? null);
                    if ($category == 'in_house') {
                        $brand = 'In-House';
                    } else {
                        $brand = '';
                    }
                @endphp

                {!! Form::text('brand', $batch->brand ?? $brand, [
                    'class' => 'form-control form-select-sm need-word-match',
                    'placeholder' => 'Type here...',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'brand.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Supplier <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text('supplier', $batch->supplier ?? null, [
                    'class' => 'form-control form-select-sm need-word-match',
                    'placeholder' => 'Type here...',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'supplier.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Unit of measure <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('unit_of_measure', $unit_packing_size_db, $material_product->unit_of_measure ?? null, [
                    'class' => 'form-select form-select-sm',
                    'placeholder' => '-- Select --',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'unit_of_measure.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Unit packing value <sup class="text-danger">*</sup></label>
            <div class="col-8">
                @php
                    if (!is_null(request()->route()->is_parent)) {
                        $upv = $material_product->unit_packing_value ?? null;
                    } else {
                        $upv = $batch->unit_packing_value ?? null;
                    }
                @endphp
                {!! Form::number('unit_packing_value', $upv, [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Type here...',
                    'required',
                    'step' => '0.01',
                    config(
                        is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'unit_packing_value.status',
                    ),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Quantity <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::number('quantity', $batch->quantity ?? null, [
                    'class' => 'form-control form-select-sm three-digits',
                    'placeholder' => 'Type here...',
                    'required',
                    'min' => 1,
                    'step' => 'any',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'quantity.status'),
                ]) !!}
            </div>
        </div>
        @env('local')
            <div class="row m-0 y-center my-2">
                <label for="" class="col-4">Unique Barcode </label>
                <div class="col-8">
                    {!! Form::number(
                        'barcode_number',
                        wizard_mode() === 'duplicate'
                            ? generateBarcode(category_type() ?? ($material_product->category_selection ?? null))
                            : $batch->barcode_number ?? generateBarcode(category_type() ?? ($material_product->category_selection ?? null)),
                        ['class' => 'form-control form-select-sm', 'readonly'],
                    ) !!}
                </div>
            </div>
            @else
            {!! Form::hidden(
                'barcode_number',  wizard_mode() === 'duplicate'
                    ? generateBarcode(category_type() ?? ($material_product->category_selection ?? null))
                    : $batch->barcode_number ?? generateBarcode(category_type() ?? ($material_product->category_selection ?? null)),
                ['class' => 'form-control form-select-sm', 'readonly'],
            ) !!}
        @endenv
    </div>
    <div class="col-lg-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Batch # <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text('batch', $batch->batch ?? null, [
                    'class' => 'form-control form-select-sm',
                    'placeholder' => 'Type here...',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'batch.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Serial # <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::text(
                    'serial',
                    is_reset('serial', $batch->serial ?? null, category_type() ?? ($material_product->category_selection ?? null)),
                    [
                        'class' => 'form-control form-select-sm',
                        'placeholder' => 'Type here...',
                        'required',
                        config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'serial.status'),
                    ],
                ) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">PO number <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {{-- {{ dd(config("is_disable.duplicate.material.po_number.reset"))}} --}}
                {!! Form::text(
                    'po_number',
                    is_reset(
                        'po_number',
                        $batch->po_number ?? null,
                        category_type() ?? ($material_product->category_selection ?? null),
                    ),
                    [
                        'class' => 'form-control form-select-sm',
                        'placeholder' => 'Type here...',
                        'required',
                        config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'po_number.status'),
                    ],
                ) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Statutory body <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('statutory_body', $statutory_body_db, $batch->statutory_body ?? null, [
                    'class' => 'form-select form-select-sm',
                    'placeholder' => '-- Select --',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'statutory_body.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">EUC material <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('euc_material', ['No', 'Yes'], $batch->euc_material ?? null, [
                    'class' => 'form-select form-select-sm',
                    'required',
                    config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'euc_material.status'),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Require bulk volume tracking<sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('require_bulk_volume_tracking', ['No', 'Yes'], $batch->require_bulk_volume_tracking ?? null, [
                    'class' => 'form-select form-select-sm',
                    'required',
                    config(
                        is_disable(category_type() ?? ($material_product->category_selection ?? null)) .
                            'require_bulk_volume_tracking.status',
                    ),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Require outlife tracking<sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('require_outlife_tracking', ['No', 'Yes'], $batch->require_outlife_tracking ?? null, [
                    'class' => 'form-select form-select-sm',
                    'required',
                    'id' => 'require_outlife_tracking_status_input',
                    'onchange' => 'outlifeChange()',
                    config(
                        is_disable(category_type() ?? ($material_product->category_selection ?? null)) .
                            'require_outlife_tracking.status',
                    ),
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">
                Outlife
                <small class="text-success">(days)</small>
                <sup class="text-danger">*</sup>
            </label>
            <div class="col-8">
                @if (session()->get('edit_mode') == 'parent')
                    {!! Form::number('outlife', $batch->outlife_days ?? null, [
                        'class' => 'form-control form-control-sm',
                        'required',
                        'placeholder' => 'Type here...',
                        'required',
                        config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'outlife.status'),
                    ]) !!}
                @else
                    {!! Form::number('outlife', $batch->outlife_days ?? null, [
                        'class' => 'form-control form-control-sm',
                        'required',
                        'placeholder' => 'Type here...',
                        'required',
                        'id' => 'outlife_input',
                        config(is_disable(category_type() ?? ($material_product->category_selection ?? null)) . 'outlife.status'),
                    ]) !!}
                @endif

            </div>
        </div>
    </div>
</div>
