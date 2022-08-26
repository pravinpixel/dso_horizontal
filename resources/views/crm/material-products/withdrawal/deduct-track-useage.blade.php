<form action="{{ route('withdrawal.deduct-track-usage') }}" method="POST" style="border: 0 !important" onsubmit="formConfirm(event)" alert-text="@lang('global.direct_deduct_alert')">
    @csrf
    <table class="table bg-white table-hover table-centered">
        <thead >
            <tr class="text-white bg-primary-2">
                <th class="text-center" style="padding: 5px !important" colspan="8"><span class="text-center">Bulk vol tracking logsheet</span></th>
            </tr>
            <tr class="bg-primary-light text-dark">
                <th class="font-12">Item Description</th>                    
                <th class="font-12">Batch/Serial#</th>
                <th class="font-12">Last accessed</th>
                <th class="font-12">Date&time stamp</th> 
                <th class="font-12">Used Amt ()</th>
                <th class="font-12">Remain Amt ()</th>
                <th class="font-12">Remarks</th>
                <th class="font-12"> <i class="text-danger bi bi-trash3-fill"></i></th>
            </tr>
        </thead>
        <tbody>
            @if (count($deduct_track_usage) != 0)
                @foreach ($deduct_track_usage as $row)
                    <tr ng-repeat="(i,row) in deductTrackUsage">
                        <td>
                            <span>
                                <small>{{ $row->Batch->BatchMaterialProduct->item_description }}</small>
                                <input type="hidden" name="batch_id[]"  value="{{ $row->Batch->id }}">
                            </span>
                            <input type="hidden" name="id"  value="@{{ row.id }}">
                            <input type="hidden" name="category_selection"  value="@{{ row.material.category_selection }}">
                        </td>
                        <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                        <td class="child-td">  {{ auth_user()->alias_name }} </td>
                        <td class="child-td">{{ \Carbon\Carbon::now()->toDateTimeString() }}</td>
                        <td><small>{{ $row->Batch->unit_packing_value }} {{ $row->Batch->BatchMaterialProduct->UnitOfMeasure->name }}</small></td>
                        <td class="child-td">
                             54
                        </td>
                        <td class="child-td py-0 px-1">
                            <textarea ng-disabled="row.material.end_of_material_product == 1" name="remarks"  class="form-control h-100 w-100"></textarea>
                        </td>
                        <td class="child-td">
                            <i onclick="deleteRow({{ $row->id }},'DEDUCT_TRACK_USAGE')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="d-flex align-items-center border-top pt-3">
        <div class="col-6 ms-auto text-end"> 
            <label for="end_of_material_product" class="p-2" >
                <input type="checkbox" onclick="checkboxConfirm(event)" alert-text="@lang('global.end_batch')"   name="end_of_material_product" value="1" class="form-check-input me-2" id="end_of_material_product"> 
                End of material/product
            </label>
            <button type="submit" class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
        </div>
    </div>
</form>