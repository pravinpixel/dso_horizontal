@if (count($deduct_track_outlife) != 0)
    <form action="{{ route('deduct-track-outlife') }}" method="POST">
        @csrf
        <table class="table bg-white  table-centered text-center">
            <thead>
                <tr class="text-white bg-primary-2">
                    <th style="padding: 5px !important;" colspan="11"><span class="text-center">Withdrawal Cart</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deduct_track_outlife as $row)
                    <tr>
                        <td colspan="10" class="border">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td colspan="10" class="bg-light">BARCODE : <b>
                                                {{ $row['barcode_number'] ?? '' }}</b></td>
                                    </tr>
                                    <tr class="bg-primary-light text-dark">
                                        <th class="font-12">Item description</th>
                                        <th class="font-12">Brand</th>
                                        <th class="font-12">Batch#/ Serial#</th>
                                        <th class="font-12">Last accessed</th>
                                        <th class="font-12">Date & time stamp</th>
                                        <th class="font-12">Pkt size</th>
                                        <th class="font-12">Qty</th>
                                        <th class="font-12">Remarks</th>
                                        <th class="font-12">Outlife expiry from last date/time</th>
                                        <th class="font-12">Outlife expiry from current date/time</th>
                                    </tr>
                                    @foreach (array_reverse($row['RepackOutlife']) as $key => $repack)
                                        @if ($repack['updated_outlife_seconds'])
                                            <tr>
                                                <td>
                                                    <small>{{ $row->item_description }}</small>
                                                    <input type="hidden" name="id[]" value="{{ $repack['id'] }}">
                                                </td>
                                                <td><small>{{ $row->Batch->brand }}</small></td>
                                                <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small>
                                                </td>
                                                <td class="p-0"><small> {{ auth_user()->alias_name }} </small></td>
                                                <td>{{ \Carbon\Carbon::now()->toDateTimeString() }}</td>
                                                <td><small>{{ $row->Batch->unit_packing_value }}</small></td>
                                                <td><small>{{ $repack['quantity'] }}</small></td>
                                                <td class="p-0 py-0 px-1">
                                                    <textarea name="remarks[]" class="form-control h-100 w-100"></textarea>
                                                </td>
                                                <td class="child-td"><small
                                                        class="text-dark">{{ $repack['updated_outlife'] ?? '-' }}</small>
                                                </td>
                                                <td class="child-td"><small
                                                        class="text-dark">{{ $repack['current_outlife_expiry'] ?? '-' }}</small>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end ">
            <label for="print_outlife_expiry" class="p-2">
                <input type="checkbox" name="print_outlife_expiry" value="1" class="form-check-input me-2"
                    id="print_outlife_expiry">
                Print outlife expiry
            </label>
            <button type="submit" class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
        </div>
    </form>
    @else
    {!! no_data_found() !!}
@endif 