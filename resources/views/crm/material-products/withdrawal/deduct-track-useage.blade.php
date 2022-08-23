<form action="{{ route('withdrawal.deduct-track-usage') }}" method="POST" style="border: 0 !important" onsubmit="formConfirm(event)" alert-text="@lang('global.direct_deduct_alert')">
    @csrf
    <table class="table bg-white table-bordered table-hover table-centered">
        <thead>
            <tr class="bg-primary text-white">
                <th class="bg-dark text-center text-white" style="padding: 5px !important" colspan="8"><span class="text-center">Bulk vol tracking logsheet</span></th>
            </tr>
            <tr>
                <th class="text-center child-td-lg"> Item Description</th>                    
                <th class="text-center child-td">Batch/Serial#</th>
                <th class="text-center child-td">Last accessed</th>
                <th class="text-center">Date&time stamp</th> 
                <th class="text-center">Used Amt (@{{ deductTrackUsage[0].material.unit_of_measure.name }})</th>
                <th class="text-center">Remain Amt (@{{ deductTrackUsage[0].material.unit_of_measure.name }})</th>
                <th class="text-center">Remarks</th>
                <th class="text-center"> <i class="text-danger bi bi-trash3-fill"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="batch in  deductTrackUsage[0].deduct_track_usage">
                <td>
                    <span>
                        @{{ batch.item_description }}
                    </span> 
                </td>
                <td>@{{ batch.batch_serial }}</td>
                <td class="child-td">@{{ batch.last_accessed }}</td>
                <td class="child-td">@{{ batch.created_at  | date:'yyyy-MM-dd HH:mm:ss' }}</td>
                <td class="child-td">@{{ batch.used_amount }} @{{ deductTrackUsage[0].material.unit_of_measure.name }}</td>
                <td class="child-td">@{{ batch.remain_amount }} @{{ deductTrackUsage[0].material.unit_of_measure.name }}</td>
                <td class="child-td">@{{ batch.remarks }}</td>
                <td class="child-td"></td>
            </tr>
            <tr ng-repeat="(i,row) in deductTrackUsage">
                <td>
                    <span>
                        @{{ row.material.item_description }}
                    </span>
                    <input type="hidden" name="id"  value="@{{ row.id }}">
                    <input type="hidden" name="category_selection"  value="@{{ row.material.category_selection }}">
                </td>
                <td>@{{ row.batch }} / @{{ row.serial }}</td>
                <td class="child-td">  {{ auth_user()->alias_name }} </td>
                <td class="child-td">{{ \Carbon\Carbon::now()->toDateTimeString() }}</td>
                <td class="child-td">
                    <div class="d-flex align-items-center ">
                        <input step="any" ng-disabled="row.material.end_of_material_product == 1" name="used_value" type="number" required ng-model="used_value" class="me-2 form-control text-center p-0"> 
                        <span>@{{ deductTrackUsage[0].material.unit_of_measure.name }}</span>
                    </div>
                </td>
                <td class="child-td">
                    @{{ (row.quantity * row.unit_packing_value) - used_value }} @{{ deductTrackUsage[0].material.unit_of_measure.name }}
                </td>
                <td class="child-td py-0 px-1">
                    <textarea ng-disabled="row.material.end_of_material_product == 1" name="remarks" required class="form-control h-100 w-100"></textarea>
                </td>
                <td class="child-td">
                    <i ng-click="removeDeductTrackUsageRow(i)" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex align-items-center border-top pt-3">
        <div class="col-6 ms-auto text-end"> 
            <label for="end_of_material_product" class="p-2" >
                <input type="checkbox" onclick="checkboxConfirm(event)" alert-text="@lang('global.end_batch')"   name="end_of_material_product" value="1" class="form-check-input me-2" id="end_of_material_product"> 
                End of material/product
            </label>
            <button type="submit" ng-disabled="deductTrackUsage[0].material.end_of_material_product == 1" class="btn btn-primary h-100 rounded-pill">Click to Confirm deduction</button>
        </div>
    </div>
</form>