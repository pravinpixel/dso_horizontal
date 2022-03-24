@extends('masters.index')

@section('masters') 
    
    <div class="card">
        <div class="card-header text-end ">
            <a class="btn btn-primary"  href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Add User</a>
        </div> 
        <div class="card-body"> 
            <table class="table table-bordered table-centered text-center m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th class="table-th">No</th>
                        <th class="table-th">Name</th>
                        <th class="table-th">Login ID</th>
                        <th class="table-th">Last Login</th>
                        <th class="table-th">Roles</th>
                        <th class="table-th">Status</th>
                        <th class="table-th" width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>  
@endsection 

@section('scripts')
<script type="text/javascript">
    $(function () {
      
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'email', name: 'email'},               
                {data: 'last_login', name: 'last_login'},
                {data: 'role', name: 'role', defaultContent: '',},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
      
    });
</script>  
@endsection