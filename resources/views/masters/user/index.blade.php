@extends('masters.index')

@section('masters') 
    <div class="text-end mb-3">
        <a class="btn btn-primary"  href="{{ route('user.create') }}">Add User to Role</a>
    </div> 
    <div class="card">
        <div class="card-body"> 
            <table class="table table-bordered table-centered text-center m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="100px">Action</th>
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
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>
@endsection