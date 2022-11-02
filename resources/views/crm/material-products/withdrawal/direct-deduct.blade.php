<form action="{{ route('direct-deduct') }}" method="POST" onsubmit="formConfirm(event)" alert-text="@lang('global.direct_deduct_alert')">
    @csrf
    <table class="table bg-white table-borderless border table-centered">
        <thead class="border-bottom">
            <tr class="bg-primary-2 text-white">
                <th class="text-center text-white" style="padding: 5px !important;" colspan="9">
                    <span class="text-center">Withdrawal Cart</span>
                </th>
            </tr>
            <tr class="bg-primary-light text-dark"> 
                <th class="font-12">Item description</th>
                <th class="font-12">Barcode</th>
                <th class="font-12">Brand</th>
                <th class="font-12">Batch#/ Serial#</th>
                <th class="font-12">Unit packing value</th>
                <th class="font-12">Quantity</th>
                <th class="font-12">Withdraw Qty</th>
                <th class="font-12">Remarks</th>
                <th class="table-th child-td text-center"> <i class="text-danger bi bi-trash3-fill"></i></th>
            </tr>
        </thead>
        <tbody>
            @if(count($direct_deducts) != 0) 
                @foreach ($direct_deducts as $row)
                    <tr>
                        <td>
                            <small>{{ $row->Batch->BatchMaterialProduct->item_description }}</small>
                            <input type="hidden" name="batch_id[]"  value="{{ $row->Batch->id }}">
                        </td>
                        <td><small>{{ $row->Batch->barcode_number }}</small></td>
                        <td><small>{{ $row->Batch->brand }}</small></td>
                        <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                        <td><small>{{ $row->Batch->unit_packing_value }} {{ $row->Batch->BatchMaterialProduct->UnitOfMeasure->name }}</small></td>
                        <td><small>{{ $row->Batch->quantity }}</small></td>
                        <td width="170px" style="position: relative;"> 
                            <input required type="text" name="quantity[]" step="any" max="{{ $row->Batch->quantity }}" readonly type="number" class="fw-bold  form-control text-center form-control-sm" style="width: 100px" value="{{ $row->quantity }}" >
                            @if ($row->quantity > 1)
                                <span style="position: absolute; top: 16%; right: 5%;" class="font-18 bi bi-dash-circle text-danger btn" onclick="decreaseQuantity({{ $row->id }},'DIRECT_DEDUCT')"></span>
                            @endif
                        </td>
                        <td class="child-td py-0 px-1">
                            <textarea name="remarks[]" class="form-control font-12"></textarea>
                        </td>
                        <td class="text-center d-flex">
                            <i onclick="deleteRow({{ $row->id }},'DIRECT_DEDUCT')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            <i onclick="viewBatch({{ $row->Batch->id }})" class="btn btn-sm border shadow btn-primary rounded-pill bi bi-eye ms-2"></i>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            @endif 
        </tbody>
    </table>
    <div class="text-end"> 
        <button type="submit" class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
    </div>
</form>