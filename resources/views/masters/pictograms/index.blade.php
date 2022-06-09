@extends('masters.index')

@section('masters') 
    <div class="card">
        <div class="card-header text-end ">
            <a class="btn btn-primary"  href="{{ route('pictogram.create') }}"><i class="fa fa-plus"></i> Add Pictogram</a>
        </div> 
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th class="table-th">No</th>
                        <th class="table-th">Name</th>
                        <th class="table-th">Image</th>
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
                ajax: "{{ route('pictogram.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>  
@endsection