<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Login ID</th>
            <th>Barcode</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($staffs as $key =>  $staff)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $staff['alias_name'] }}</td>
                <td>{{ $staff['email'] }}</td>
                <td>{{ $staff['email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>