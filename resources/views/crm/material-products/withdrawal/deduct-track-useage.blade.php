<form action="{{ route('deduct-track-usage') }}" method="POST" style="border: 0 !important" onsubmit="formConfirm(event)" alert-text="@lang('global.direct_deduct_alert')">
    @csrf
    <table class="table bg-white table-hover table-centered">
        <thead >
            <tr class="text-white bg-primary-2">
                <th class="text-center" style="padding: 5px !important" colspan="10"><span class="text-center">Bulk vol tracking logsheet</span></th>
            </tr>
            <tr class="bg-primary-light text-dark">
                <th class="font-12">Item Description</th>                    
                <th class="font-12">Batch/Serial#</th>
                <th class="font-12">Last accessed</th>
                <th class="font-12">Date&time stamp</th> 
                <th class="font-12">Unit Packing Value</th> 
                <th class="font-12">Quantity</th> 
                <th class="font-12">Used Amt ({{ count($deduct_track_usage) != 0 ? $deduct_track_usage[0]->Batch->BatchMaterialProduct->UnitOfMeasure->name  : ''}})</th>
                <th class="font-12">Remain Amt ({{ count($deduct_track_usage) != 0 ? $deduct_track_usage[0]->Batch->BatchMaterialProduct->UnitOfMeasure->name : '' }})</th>
                <th class="font-12">Remarks</th>
                <th class="font-12"> <i class="text-danger bi bi-trash3-fill"></i></th>
            </tr>
        </thead>
        <tbody> 
            @if (count($deduct_track_usage_history ?? []) != 0)
                @foreach ($deduct_track_usage_history as $row)
                    <tr>
                        <td><small>{{ $row->item_description }}</small></td>
                        <td><small>{{ $row->batch_serial }}</small></td>
                        <td><small>{{ $row->last_accessed }}</small></td>
                        <td><small>{{ $row->created_at->format('Y-m-d h:m:s') }}</small></td>
                        <td><small>1</small></td>
                        <td><small>1</small></td>
                        <td><small>{{ $row->used_amount }}</small></td>
                        <td><small>{{ $row->remain_amount }}</small></td>
                        <td><small>{{ $row->remarks }}</small></td>
                        <td>-</td>
                    </tr>
                @endforeach 
            @endif
            @if (count($deduct_track_usage) != 0)
                @foreach ($deduct_track_usage as $row)
                    <tr>
                        <td>
                            <span>
                                <small>{{ $row->Batch->BatchMaterialProduct->item_description }}</small>
                                <input type="hidden" name="batch_id"  value="{{ $row->Batch->id }}">
                            </span>
                        </td>
                        <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                        <td> {{ auth_user()->alias_name }} </td>
                        <td>{{ \Carbon\Carbon::now()->toDateTimeString() }}</td>
                        <td><small>{{ $row->Batch->unit_packing_value }}</small></td>
                        <td><small>{{ $row->Batch->quantity }}</small></td>
                        <td width="100px">
                            <div class="d-flex align-items-center">
                                <input id="used_amount" name="used_amount" step="any" max="{{ $row->Batch->quantity }}"  onkeyup="startTrackUsage({{ $row->Batch->quantity }},this.value)" type="number" style="width: 80px" value="0" class="me-2 form-control-sm form-control">
                                <small>{{ $row->Batch->BatchMaterialProduct->UnitOfMeasure->name }}</small>
                            </div>
                        </td>
                        <td> 
                            <div class="d-flex align-items-center">
                                <input id="remain_amount" name="remain_amount" step="any" readonly type="text" style="width: 80px" value="{{ $row->Batch->quantity  }}" class="me-2 form-control-sm form-control">
                                <small>{{ $row->Batch->BatchMaterialProduct->UnitOfMeasure->name }}</small>
                            </div> 
                        </td>
                        <td class="child-td py-0 px-1">
                            <textarea name="remarks"  class="form-control h-100 w-100"></textarea>
                        </td>
                        <td>
                            <i onclick="deleteRow({{ $row->id }},'DEDUCT_TRACK_USAGE')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
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
                    <td>-</td>
                </tr>
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