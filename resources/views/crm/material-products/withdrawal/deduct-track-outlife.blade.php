<form action="{{ route('withdrawal.deduct-track-outlife') }}" method="POST">
    @csrf 
    <table class="table bg-white  table-centered text-center">
        <thead>
            <tr class="text-white bg-red">
                <th style="padding: 5px !important;" colspan="11"><span class="text-center">Withdrawal Cart</span></th>
            </tr>
            <tr class="bg-red-light text-dark">
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
                    <tr ng-repeat="row in deductTrackOutlife[0].repack_outlife | orderBy:'$index':true" ng-if="row.draw_in == 1 && row.draw_out == 1">
                        <td class="p-0"><small> tewtw </small></td>
                        <td class="p-0"><small> ewt </small></td>
                        <td class="p-0"><small> <small class="text-primary">ew</small> / <small class="text-info">dsd</small> </small></td>
                        <td class="p-0"><small> s </small></td>
                        <td class="p-0"><small> s </small></td>
                        <td class="p-0"><small> sd</small></td>
                        <td class="p-0"><small>sdg </small></td>
                        <td class="p-0"><small> s </small></td>
                        <td class="p-0 py-0 px-1">
                            <input type="hidden" name="id[]" value="@{{ row.id }}">
                            <textarea name="remarks[]" class="form-control h-100 w-100">ewtwet</textarea>
                        </td>
                        <td class="child-td"><small class="text-dark">we</small></td>
                        <td class="child-td"><small class="text-dark">dfghdfg</small></td>
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
        <button type="submit" class="bg-red btn btn-dark rounded-pill">Click to Confirm deduction</button>
    </div>
</form>