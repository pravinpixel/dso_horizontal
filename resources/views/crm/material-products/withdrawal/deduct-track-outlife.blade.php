<form action="{{ route('deduct-track-outlife') }}" method="POST">
    @csrf 
    <table class="table bg-white  table-centered text-center">
        <thead>
            <tr class="text-white bg-primary-2">
                <th style="padding: 5px !important;" colspan="11"><span class="text-center">Withdrawal Cart</span></th>
            </tr>
            <tr class="bg-primary-light text-dark">
                <th class="font-12">Item description</th>
                <th class="font-12">Brand</th>
                <th class="font-12">Batch#/ Serial#</th>
                <th class="font-12">Last accessed</th>
                <th class="font-12">Date & time stamp</th>
                <th class="font-12">Unique Barcode Label</th>
                <th class="font-12">Pkt size</th>
                <th class="font-12">Qty</th>
                <th class="font-12">Remarks</th>
                <th class="font-12">Outlife expiry from last date/time</th>
                <th class="font-12">Outlife expiry from current date/time</th>
            </tr>
        </thead>
        <tbody>
            @if (count($deduct_track_outlife) != 0)
                @foreach ($deduct_track_outlife as $row)
                    <tr>
                        <td>
                            <small>{{ $row->Batch->BatchMaterialProduct->item_description }}</small>
                            <input type="hidden" name="id[]"  value="{{ $row->id }}">
                        </td>
                        <td><small>{{ $row->Batch->brand }}</small></td>
                        <td><small>{{ $row->Batch->batch }} / {{ $row->Batch->serial }}</small></td>
                        <td class="p-0"><small>  {{ auth_user()->alias_name }} </small></td>
                        <td>{{ \Carbon\Carbon::now()->toDateTimeString() }}</td>
                        <td><small>{{ $row->Batch->barcode_number }}</small></td>
                        <td><small>{{ $row->Batch->unit_packing_value }}</small></td>
                        <td><small>{{ $row->Batch->quantity }}</small></td>
                        <td class="p-0 py-0 px-1">
                            <textarea name="remarks[]" class="form-control h-100 w-100"></textarea>
                        </td>
                        <td class="child-td"><small class="text-dark">{{ $row->RepackOutlife->updated_outlife ?? "-" }}</small></td>
                        <td class="child-td"><small class="text-dark">{{ $row->RepackOutlife->current_outlife_expiry ?? "-" }}</small></td>
                    </tr>   
                @endforeach
            @endif
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