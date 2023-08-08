<table class="table table-bordered table-sm">
    <thead class="bg-primary text-white text-center">
        <tr>
            <th style="font-weight: bold">Category selection</th>
            <th style="font-weight: bold">Item description</th>
            <th style="font-weight: bold">Brand</th>
            <th style="font-weight: bold">Batch#/Serial#</th>
            <th style="font-weight: bold">Transaction date</th>
            <th style="font-weight: bold">Transaction time</th>
            <th style="font-weight: bold">Transacted</th>
            <th style="font-weight: bold">Module</th>
            <th style="font-weight: bold">Action Taken</th>
            <th style="font-weight: bold">Unit packing value</th>
            <th style="font-weight: bold">Quantity</th>
            <th style="font-weight: bold">Total quantity</th>
            <th style="font-weight: bold">Storage area</th>
            <th style="font-weight: bold">Housing </th>
            <th style="font-weight: bold">Owners</th>
            <th style="font-weight: bold">Remarks</th>
            <th style="font-weight: bold">Draw status</th>
            <th style="font-weight: bold">Remaining outlife of parent </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materialProductHistory as $data)
            <tr>
                <td>{{ $data->CategorySelection }}</td>
                <td>{{ $data->ItemDescription }}</td>
                <td>{{ $data->Brand }}</td>
                <td>{{ $data->BatchSerial }}</td>
                <td>{{ $data->created_at->format('d/m/Y') }}</td>
                <td>{{ $data->created_at->format('H:i:s A') }}</td>
                <td>{{ $data->TransactionBy }}</td>
                <td>{{ $data->Module }}</td>
                <td>{{ $data->ActionTaken }}</td>
                <td>{{ $data->UnitPackingValue }}</td>
                <td>{{ $data->Quantity }}</td>
                <td>{{ number_format($data->UnitPackingValue *  $data->Quantity, 3, ".", "") }}</td>
                <td>{{ $data->StorageArea }}</td>
                <td>{{ $data->Housing }}</td>
                <td>{{ $data->Owners }}</td>
                <td>{{ $data->Remarks }}</td>
                <td>{{ $data->DrawStatus }}</td>
                <td>{{ $data->RemainingOutlifeOfParent }}</td> 
            </tr>
        @endforeach
    </tbody>
</table>