<table>
    <thead>
        <tr>
            <th width="151px" style="font-weight: bold">Item Description</th>
            <th width="111px" style="font-weight: bold">Brand</th>
            <th width="196px" style="font-weight: bold">Batch/Serial</th>
            <th width="93px" style="font-weight: bold">Quantity</th>
            <th width="93px" style="font-weight: bold">Storage area</th>
            <th width="101px" style="font-weight: bold">Housing</th>
            <th width="122px" style="font-weight: bold">Owners</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $batch->BatchMaterialProduct->item_description }}</td>
            <td>{{ $batch->brand }}</td>
            <td>{{ $batch->batch }} / {{ $batch->serial }}</td>
            <td>{{ $batch->quantity }}</td>
            <td>{{ $batch->StorageArea->name }}</td>
            <td>{{ $batch->housing_type.'  - '.$batch->housing  }}</td>
            <td>
                @if (count($batch->BatchOwners ?? []))
                    @foreach ($batch->BatchOwners as $key => $owner)
                        @if ($owner->alias_name ?? false)
                            {{ $owner->alias_name }},
                        @endif
                    @endforeach
                @endif
            </td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th  width="151px" style="font-weight: bold">Action Taken</th>
            <th  width="151px" style="font-weight: bold">Transaction Date</th>
            <th  width="151px" style="font-weight: bold">Transaction Time</th>
            <th  width="151px" style="font-weight: bold">Transacted by</th>
            <th  width="151px" style="font-weight: bold">Draw out Amt</th>
            <th  width="151px" style="font-weight: bold">Remaining amt</th>
            <th  width="151px" style="font-weight: bold">Remainder outlife</th>
            <th width="117px" style="font-weight: bold">Auto gen Barcode </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($batch->RepackOutlife as $repack)
            @if ($repack->draw_in == 1 && $repack->draw_out == 1)
                <tr>
                    <td>Draw OUT</td>
                    <td>{{ $repack->created_at->format('d/m/Y') }}</td>
                    <td>{{ $repack->created_at->format('H:i:s A') }}</td>
                    <td>{{ $repack->User->alias_name ?? '' }}</td>
                    <td>{{ $repack->old_input_repack_amount }}</td>
                    <td>{{ $repack->remain_amount }}</td>
                    <td>{{ $repack->remain_days }}</td>
                    <td>{{ $batch->barcode_number }}</td>
                </tr>
                <tr>
                    <td>Draw IN</td>
                    <td>{{ $repack->updated_at->format('d/m/Y') }}</td>
                    <td>{{ $repack->updated_at->format('H:i:s A') }}</td>
                    <td>{{ $repack->User->alias_name ?? '' }}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ $repack->remain_days }}</td>
                    <td>{{ $batch->barcode_number }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
