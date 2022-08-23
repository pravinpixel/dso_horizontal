<form action="{{ route('withdrawal.direct-deduct') }}" method="POST" onsubmit="formConfirm(event)" alert-text="@lang('global.direct_deduct_alert')">
    @csrf
    <table class="table bg-white table-borderless border table-centered table-hover">
        <thead class="border-bottom">
            <tr class="bg text-white">
                <th class="bg-dark text-center text-white" style="padding: 5px !important;" colspan="7">
                    <span class="text-center">Withdrawal Cart</span>
                </th>
            </tr>
            <tr class="bg-light text-primary"> 
                <th class="table-th child-td">Item description</th>
                <th class="table-th child-td">Brand</th>
                <th class="table-th child-td">Batch#/ Serial#</th>
                <th class="table-th child-td">Unit packing value</th>
                <th class="table-th child-td">Withdraw Qty</th>
                <th class="table-th child-td">Remarks</th>
                <th class="table-th child-td text-center"> <i class="text-danger bi bi-trash3-fill"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="(index,row) in directDeduct">
                <td>
                    <span>
                        @{{ row.item_description }}
                    </span>
                    <input type="hidden" name="id[]"  value="@{{ row.id }}">
                    <input type="hidden" name="category_selection[]"  value="@{{ row.category_selection }}">
                </td>
                <td>@{{ row.brand }}</td>
                <td>@{{ row.batch }} / @{{ row.serial }}</td>
                <td>@{{ row.unit_packing_value }} @{{ row.unit_of_measure }}</td>
                <td><input name="quantity[]" type="number" class="form-control w-auto p-0 form-control-sm text-center" readonly value="@{{ row.direct_detect_quantity }}" required></td>
                <td class="child-td py-0 px-1">
                    <textarea name="remarks[]" class="form-control h-100 w-100" required></textarea>
                </td>
                <td class="text-center">
                    <i ng-click="removeDirectDetectRow(index)" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="text-end"> 
        <button type="submit" class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
    </div>
</form>