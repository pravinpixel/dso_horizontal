<form action="{{ route('withdrawal.deduct-track-outlife') }}" method="POST">
    @csrf 
    <table class="table bg-white table-bordered table-centered text-center">
        <thead>
            <tr class="bg text-white">
                <th class="bg-dark text-center text-white" style="padding: 5px !important;" colspan="11"><span class="text-center">Withdrawal Cart</span></th>
            </tr>
            <tr class="bg-primary text-white">
                <th class="table-th child-td">Item description</th>
                <th class="table-th child-td">Brand</th>
                <th class="table-th child-td">Batch#/ Serial#</th>
                <th class="table-th child-td">Last accessed</th>
                <th class="table-th child-td">Date & time stamp</th>
                <th class="table-th child-td">Unique Barcode Label</th>
                <th class="table-th child-td">Pkt size</th>
                <th class="table-th child-td">Qty</th>
                <th class="table-th child-td">Remarks</th>
                <th class="table-th child-td">Outlife expiry from last date/time</th>
                <th class="table-th child-td">Outlife expiry from current date/time</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="row in deductTrackOutlife[0].repack_outlife | orderBy:'$index':true" ng-if="row.draw_in == 1 && row.draw_out == 1">
                <td class="p-0"><small> @{{ deductTrackOutlife[0].item_description }} </small></td>
                <td class="p-0"><small> @{{ deductTrackOutlife[0].brand }} </small></td>
                <td class="p-0"><small> <small class="text-primary">@{{ deductTrackOutlife[0].batch }}</small> / <small class="text-info">@{{ deductTrackOutlife[0].serial }}</small> </small></td>
                <td class="p-0"><small> {{ auth_user()->alias_name }}  </small></td>
                <td class="p-0"><small> @{{ row.current_date_time }} </small></td>
                <td class="p-0"><small> @{{ deductTrackOutlife[0].barcode_number }} </small></td>
                <td class="p-0"><small> @{{ row.repack_size }} </small></td>
                <td class="p-0"><small> @{{ row.qty_cut }} </small></td>
                <td class="p-0 py-0 px-1">
                    <input type="hidden" name="id[]" value="@{{ row.id }}">
                    <textarea name="remarks[]" class="form-control h-100 w-100">@{{ row.remarks }}</textarea>
                </td>
                <td class="child-td"><small class="text-dark">@{{ row.updated_outlife }}</small></td>
                <td class="child-td"><small class="text-dark">@{{ row.current_outlife_expiry }}</small></td>
            </tr>
        </tbody>
    </table>
    <div class="text-end ">
        <label for="print_outlife_expiry" class="p-2">
            <input type="checkbox" name="print_outlife_expiry" value="1" class="form-check-input me-2" id="print_outlife_expiry"> 
            Print outlife expiry
        </label>
        <button class="btn btn-info rounded-pill">Confirm Deduction</button> 
    </div>
</form>