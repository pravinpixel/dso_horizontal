@extends('masters.index')

@section('masters') 
    <div class="card">
        <div class="card-body"> 
            
            <div class="text-end mb-3">
                <a class="btn btn-primary"  href="{{ route('user.create') }}">Add User to Role</a>
            </div>
            
            {{-- <table class="table table-bordered table-centered text-center m-0 tr-sm table-hover">
                <thead class="bg-primary-2 text-white"> 
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Role</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $i => $user)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->roles  }}</td> 
                        </tr>
                    @endforeach 
                </tbody> 
            </table> --}}
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>  
@endsection 

@section('scripts')
<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
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