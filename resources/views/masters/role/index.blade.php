@extends('masters.index')

@section('masters') 
    
    <div class="card">
        <div class="card-header text-end ">
            <a class="btn btn-primary"  href="{{ route('role.create') }}"><i class="fa fa-plus"></i> Add Role</a>
        </div> 
        <div class="card-body"> 
            <table class="table table-bordered table-centered text-center m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th class="table-th" width="10%">No</th>
                        <th class="table-th">Name</th>
                        <th class="table-th">Created At</th>
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
                ajax: "{{ route('role.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection