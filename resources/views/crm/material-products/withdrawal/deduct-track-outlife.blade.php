@if (count($deduct_track_outlife) != 0)
    <form action="{{ route('deduct-track-outlife') }}" method="POST">
        @csrf
        <div class="bg-light mb-2 border rounded p-1">
            <b class="text-center text-primary">Withdrawal Cart</b>
        </div>
        <table class="table bg-white table-centered text-center">
            <tbody>
                @foreach ($deduct_track_outlife as $row)
                    @if (is_repack_outlife($row->RepackOutlife))
                        <tr>
                            <td colspan="11" class="pt-0 px-0">
                                <div class="card border shadow-sm m-0">
                                    <div class="card-header m-0 bg-primary-2 text-white border-bottom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>BARCODE : <b> {{ $row->batch->barcode_number }}</b></div>
                                            <div>
                                                <i onclick="viewBatch({{ $row->Batch->id }})" class="btn btn-sm border shadow btn-primary rounded-pill bi bi-eye ms-2"></i>
                                                <i onclick="deleteRow({{ $row->id }},'DEDUCT_TRACK_OUTLIFE')" class="btn btn-sm btn-danger border shadow rounded-pill bi bi-trash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr class="bg-light">
                                                    <th class="font-12">Item description</th>
                                                    <th class="font-12">Batch#/ Serial#</th>
                                                    <th class="font-12">Last accessed</th>
                                                    <th class="font-12">Date & time stamp</th>
                                                    <th class="font-12">Pkt size</th>
                                                    <th class="font-12">Qty</th>
                                                    <th class="font-12">Total Qty</th>
                                                    <th class="font-12">Withdraw Qty</th>
                                                    <th class="font-12">Remarks</th>
                                                    <th class="font-12">Outlife expiry from last date/time</th>
                                                    <th class="font-12">Outlife expiry from current date/time</th>
                                                </tr> 
                                                @if (count($row->Batch->TrackOutlifeHistory) > 0)
                                                    @foreach ($row->Batch->TrackOutlifeHistory as $history)
                                                        @if ($history->type == 'WITH_DRAWING')
                                                            <tr>
                                                                <td> <small>{{ $history->item_description }}</small> </td>
                                                                <td><small>{{ $history->batch_serial }}</small></td>
                                                                <td class="p-0"><small> {{ $history->last_accessed }} </small></td>
                                                                <td><small>{{ SetDateFormatWithHour($history->created_at) }}</small></td>
                                                                <td><small>{{ $history->unit_packing_value }}</small></td>
                                                                <td><small>{{ $history->quantity }}</small></td>
                                                                <td><small>{{ $history->total_quantity }}</small></td>
                                                                <td><small>{{ $history->withdraw_quantity }}</small></td>
                                                                <td><small>{{ $history->remarks }}</small></td>
                                                                <td><small>{{ $row->RepackOutlife[0]->updated_outlife }}</small></td>
                                                                <td><small>{{ $row->RepackOutlife[0]->current_outlife_expiry }}</small></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @foreach ($row->RepackOutlife->toArray() as $key => $repack)
                                                    @if ($repack['draw_in'] == 1 && $repack['draw_out'] == 1)
                                                        @if ($key == 0)
                                                            <tr>
                                                                <td>
                                                                    <small>{{ $row->Batch->BatchMaterialProduct->item_description }}</small>
                                                                    <input type="hidden" value="{{ $row->Batch->id }}" name="batch_id[]"/>
                                                                    <input type="hidden" value="WITH_DRAWING" name="cart_type[]"/>
                                                                </td>
                                                                <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                                                                <td class="p-0"><small> {{ auth_user()->alias_name }} </small></td>
                                                                <td><small>{{ SetDateFormatWithHour(date('Y-m-d')) }}</small></td>
                                                                <td><small>{{ $row->Batch->unit_packing_value }}</small></td>
                                                                <td><small>{{ $row->Batch->quantity }}</small></td>
                                                                <td><small>{{ $row->Batch->total_quantity }}</small></td>
                                                                <td class="p-0 py-0 px-1"><input name="withdraw_quantity[]" class="form-control form-control-sm text-center" type="number"/></td> 
                                                                <td class="p-0 py-0 px-1"><input name="remarks[]" class="form-control form-control-sm" type="text" value="{{ $repack['remarks'] }}"/></td> 
                                                                <td class="child-td">
                                                                    <small class="text-dark">{{ $row->Batch->outlife }}</small>
                                                                </td>
                                                                <td class="child-td">
                                                                    <small class="text-dark">{{ $repack['current_outlife_expiry'] }}</small>
                                                                </td>
                                                            </tr> 
                                                        @endif
                                                    @endif 
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="11" class="pt-0 px-0">
                                <div class="card border shadow-sm m-0">
                                    <div class="card-header m-0 bg-primary-2 text-white border-bottom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>BARCODE : <b> {{ $row->batch->barcode_number }}</b></div>
                                            <div>
                                                <i onclick="viewBatch({{ $row->Batch->id }})" class="btn btn-sm border shadow btn-primary rounded-pill bi bi-eye ms-2"></i>
                                                <i onclick="deleteRow({{ $row->id }},'DEDUCT_TRACK_OUTLIFE')" class="btn btn-sm btn-danger border shadow rounded-pill bi bi-trash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr class="bg-light">
                                                    <th class="font-12">Item description</th>
                                                    <th class="font-12">Batch#/ Serial#</th>
                                                    <th class="font-12">Last accessed</th>
                                                    <th class="font-12">Date & time stamp</th>
                                                    <th class="font-12">Pkt size</th>
                                                    <th class="font-12">Qty</th>
                                                    <th class="font-12">Total Qty</th>
                                                    <th class="font-12">Withdraw Qty</th>
                                                    <th class="font-12">Remarks</th>
                                                </tr> 
                                                @if (count($row->Batch->TrackOutlifeHistory) > 0)
                                                    @foreach ($row->Batch->TrackOutlifeHistory as $history)
                                                        @if ($history->type == 'WITH_OUT_DRAWING')
                                                            <tr>
                                                                <td> <small>{{ $history->item_description }}</small> </td>
                                                                <td><small>{{ $history->batch_serial }}</small></td>
                                                                <td class="p-0"><small> {{ $history->last_accessed }} </small></td>
                                                                <td><small>{{ SetDateFormatWithHour($history->created_at) }}</small></td>
                                                                <td><small>{{ $history->unit_packing_value }}</small></td>
                                                                <td><small>{{ $history->quantity }}</small></td>
                                                                <td><small>{{ $history->total_quantity }}</small></td>
                                                                <td><small>{{ $history->withdraw_quantity }}</small></td>
                                                                <td><small>{{ $history->remarks }}</small></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <tr>
                                                    <td>
                                                        <input type="hidden" value="{{ $row->Batch->id }}" name="batch_id[]"/>
                                                        <input type="hidden" value="WITH_OUT_DRAWING" name="cart_type[]"/> 
                                                        <small>{{ $row->Batch->BatchMaterialProduct->item_description }}</small>
                                                    </td>
                                                    <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                                                    <td class="p-0"><small> {{ auth_user()->alias_name }} </small></td>
                                                    <td><small>{{ SetDateFormatWithHour(date('Y-m-d')) }}</small></td>
                                                    <td><small>{{ $row->Batch->unit_packing_value }}</small></td>
                                                    <td><small>{{ $row->Batch->quantity }}</small></td>
                                                    <td><small>{{ $row->Batch->total_quantity }}</small></td>
                                                    <td class="p-0 py-0 px-1"><input name="withdraw_quantity[]" class="form-control form-control-sm text-center" type="number"/></td> 
                                                    <td class="p-0 py-0 px-1"><input name="remarks[]" class="form-control form-control-sm" type="text" value=""/></td> 
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="text-end ">
            <label for="print_outlife_expiry" class="p-2">
                <input type="checkbox" name="print_outlife_expiry" value="1" class="form-check-input me-2" id="print_outlife_expiry">
                Print outlife expiry
            </label>
            <button type="submit" class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
        </div>
    </form>
@else
    {!! no_data_found() !!}
@endif
