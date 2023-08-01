@if (count($deduct_track_usage_history ?? []) != 0 || count($deduct_track_usage) != 0)
    <form action="{{ route('deduct-track-usage') }}" class="text-end" method="POST" onsubmit="formConfirm(event)"
        alert-text="@lang('global.clear_cart')">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger btn-sm mb-2" type="submit"><i class="bi bi-trash3-fill"></i> Clear
            All</button>
    </form>
    <form action="{{ route('deduct-track-usage') }}" method="POST" style="border: 0 !important"
        onsubmit="formConfirm(event)" alert-text="@lang('global.direct_deduct_alert')">
        @csrf
        <table class="table bg-white table-hover table-centered">
            <thead>
                <tr class="text-white bg-primary-2">
                    <th class="text-center" style="padding: 5px !important" colspan="11">
                        <span class="text-center">Bulk vol tracking logsheet</span>
                    </th>
                </tr>
                <tr class="bg-primary-light text-dark">
                    <th class="font-12">Item description</th>
                    <th class="font-12">Batch#/Serial#	</th>
                    <th class="font-12">Last accessed</th>
                    <th class="font-12">Date&time stamp</th>
                    <th class="font-12">Unit packing value</th>
                    <th class="font-12">Quantity</th>
                    <th class="font-12">Total quantity</th>
                    <th class="font-12">Used Total Quantity
                        ({{ count($deduct_track_usage) != 0 ? $deduct_track_usage[0]->Batch->BatchMaterialProduct->UnitOfMeasure->name : '' }})
                    </th>
                    <th class="font-12">Remain total quantity
                        ({{ count($deduct_track_usage) != 0 ? $deduct_track_usage[0]->Batch->BatchMaterialProduct->UnitOfMeasure->name : '' }})
                    </th>
                    <th class="font-12">Remarks</th>
                    <th class="font-12"> Action</th>
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
                            <td><small>{{ $deduct_track_usage[0]->Batch->unit_packing_value }}</small></td>
                            <td><small>{{ $row->quantity }}</small></td>
                            <td><small>{{ $deduct_track_usage[0]->Batch->unit_packing_value * $row->quantity }}</small>
                            </td>
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
                                    <input type="hidden" name="batch_id" value="{{ $row->Batch->id }}">
                                </span>
                            </td>
                            <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                            <td> {{ auth_user()->alias_name }} </td>
                            <td><small>{{ SetDateFormatWithHour(date('Y-m-d')) }}</small></td>
                            <td><small>{{ $row->Batch->unit_packing_value }}</small></td>
                            <td><small>{{ $row->Batch->quantity }}</small></td>
                            <td><small>{{ $row->Batch->unit_packing_value * $row->Batch->quantity }}</small></td>
                            <td width="100px">
                                <div class="d-flex align-items-center">
                                    <input id="used_amount" name="used_amount" step="any"
                                        {{-- {{ $row->Batch->BatchMaterialProduct->end_of_material_product == 1 ? 'disabled' : '' }} --}}
                                        min="0"
                                        max="{{ $row->Batch->quantity * $row->Batch->unit_packing_value }}"
                                        onkeyup="startTrackUsage({{ $row->Batch->quantity * $row->Batch->unit_packing_value }},this)"
                                        type="number" style="width: 80px" value="0"
                                        class="me-2 form-control-sm form-control">
                                    <small>{{ $row->Batch->BatchMaterialProduct->UnitOfMeasure->name }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <input id="remain_amount" name="remain_amount"   readonly
                                        min="0"
                                        type="text" style="width: 80px"
                                        value="{{ $row->Batch->quantity * $row->Batch->unit_packing_value }}"
                                        class="me-2 form-control-sm form-control">
                                    <small>{{ $row->Batch->BatchMaterialProduct->UnitOfMeasure->name }}</small>
                                </div>
                            </td>
                            <td class="child-td py-0 px-1">
                                <textarea name="remarks" 
                                {{-- {{ $row->Batch->BatchMaterialProduct->end_of_material_product == 1 ? 'disabled' : '' }} --}}
                                    class="form-control h-100 w-100"></textarea>
                            </td>
                            <td class="text-center d-flex">
                                {{-- <i onclick="deleteRow({{ $row->id }},'DEDUCT_TRACK_USAGE')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i> --}}
                                <i onclick="viewBatch({{ $row->Batch->id }})"
                                    class="btn btn-sm border shadow btn-primary rounded-pill bi bi-eye ms-2"></i>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex align-items-center border-top pt-3">
            <div class="col-6 ms-auto text-end">
                <label for="end_of_material_product" class="p-2">
                    <input
                        {{-- {{ $deduct_track_usage[0]->Batch->BatchMaterialProduct->end_of_material_product ?? null == 1 ? 'disabled' : '' }} --}}
                        type="checkbox" onclick="checkboxConfirm(event)" alert-text="@lang('global.end_batch')"
                        name="end_of_material_product" value="1" class="form-check-input me-2"
                        id="end_of_material_product">
                    End of material/product
                </label>
                <button type="submit" class="btn btn-primary rounded-pill"
                    {{-- {{ $deduct_track_usage[0]->Batch->BatchMaterialProduct->end_of_material_product ?? null == 1 ? 'disabled' : '' }} --}}
                    >Click
                    to confirm deduction</button>
            </div>
        </div>
    </form>
@else
    {!! no_data_found() !!}
@endif
