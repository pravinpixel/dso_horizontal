<table>
    <thead>
        <tr>
            <th width="151px" style="font-weight: bold">Item description</th>
            <th width="196px" style="font-weight: bold">Batch/Serial</th>
            <th width="93px" style="font-weight: bold">Quantity</th>
            <th width="93px" style="font-weight: bold">Total Quantity</th>
            <th width="93px" style="font-weight: bold">Withdraw Quantity</th>
            <th width="101px" style="font-weight: bold">Remarks</th>
            <th width="122px" style="font-weight: bold">Transaction At</th>
        </tr>
    </thead>
    <tbody>
        @if (count($batch->TrackOutlifeHistory))
            @foreach ($batch->TrackOutlifeHistory as $row)
                <tr>
                    <td>{{ $row->item_description }}</td>
                    <td>{{ $row->batch_serial }}</td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->total_quantity }}</td>
                    <td>{{ $row->withdraw_quantity }}</td>
                    <td>{{ $row->remarks }}</td>
                    <td>{{ $row->created_at }}</td>
                </tr>
            @endforeach
            @if ($batch->end_of_batch === 1)
                <tr>
                    <td>{{ $batch->BatchMaterialProduct->item_description }}</td>
                    <td>{{ $batch->batch }}/{{ $batch->serial }}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>End of Batch</td>
                    <td>{{ $batch->updated_at }}</td>
                </tr>
            @endif
        @else
            <tr>
                <td>{{ $batch->BatchMaterialProduct->item_description }}</td>
                <td>{{ $batch->batch }}/{{ $batch->serial }}</td>
                <td>{{ $batch->quantity }}</td>
                <td>{{ $batch->total_quantity }}</td>
                <td>0</td>
                <td> No History </td>
                <td>-</td>
            </tr>
        @endif
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th width="151px" style="font-weight: bold">Action Taken</th>
            <th width="151px" style="font-weight: bold">Transaction Date</th>
            <th width="151px" style="font-weight: bold">Transaction Time</th>
            <th width="151px" style="font-weight: bold">Transacted by</th>
            <th width="151px" style="font-weight: bold">Draw out Amt</th>
            <th width="151px" style="font-weight: bold">Remaining amt</th>
            <th width="151px" style="font-weight: bold">Remainder outlife</th>
            <th width="117px" style="font-weight: bold">Auto gen Barcode </th>
        </tr>
    </thead>
    <tbody>
        @if (count($batch->RepackOutlifeDrawInOut))
            @foreach ($batch->RepackOutlife as $repack)
                @if ($repack->remain_days)
                    <tr>
                        <td>Draw OUT</td>
                        <td>{{ $repack->created_at->format('d/m/Y') }}</td>
                        <td>{{ $repack->created_at->format('H:i:s A') }}</td>
                        <td>{{ $repack->User->alias_name ?? '' }}</td>
                        <td>{{ $repack->old_input_repack_amount }}</td>
                        <td>{{ $repack->remain_amount }}</td>
                        <td>{{ $repack->remain_days }}</td>
                        <td>{{ "$batch->barcode_number" }}</td>
                    </tr>
                    <tr>
                        <td>Draw IN</td>
                        <td>{{ $repack->updated_at->format('d/m/Y') }}</td>
                        <td>{{ $repack->updated_at->format('H:i:s A') }}</td>
                        <td>{{ $repack->User->alias_name ?? '' }}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $repack->remain_days }}</td>
                        <td>{{  "$batch->barcode_number" }}</td>
                    </tr>
                @endif
            @endforeach
        @endif
        <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>{{  "$batch->barcode_number" }}</td>
        </tr>
    </tbody>
</table>