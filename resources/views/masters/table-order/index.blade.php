@extends('masters.index')
@section('masters')
     <div class="card card-body">
          <table class="table table-sm table-centered" id="data-table">
               <thead>
                    <tr>
                         <th width="35px">#</th>
                         <th>Order By</th>
                         <th>Name</th>
                         <th>Status</th>
                    </tr>
               </thead>
               <tbody></tbody>
          </table> 
     </div>
@endsection
@section('styles')
     <link href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css" rel="stylesheet" />
@endsection
@section('scripts')
     <script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>
     <script>
          changeOrder    = (id) => {
               axios.post(`{{ route("table-order.store") }}/${id}`).then((response) => {
                    console.log(response.data)
               })
          }
     </script>
     <script>
               let dtOverrideGlobals = {
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    ajax: "{{ route('table-order.index') }}",
                    columns: [ 
                         { data: 'place_holder', name: 'place_holder',sortable:false }, 
                         { data: 'order_by', name: 'order_by'},
                         { data: 'column', name: 'column' },
                         { data: 'action', name: 'action' }
                    ],
                    order: [[ 1, 'asc' ]],
                    pageLength: 10,
                    rowReorder: {
                         selector: 'tr td button',
                         dataSrc: 'order_by'
                    },
               };

               let datatable = $('#data-table').DataTable(dtOverrideGlobals);
               datatable.on('row-reorder', function (e, details) {
                    if(details.length) {
                         let rows = [];
                         details.forEach(element => {
                              rows.push({
                                   id        : datatable.row(element.node).data().id,
                                   order_by  : element.newData
                              });
                         });

                         $.ajax({
                              headers: {'x-csrf-token': '{{ csrf_token() }}'},
                              method: 'POST',
                              url: "{{ route('update-orderby') }}",
                              data: { rows }
                         }).done(function () { 
                              datatable.ajax.reload() 
                         });
                    }
               });
     </script>
@endsection