@extends('masters.index')
@section('masters')
     <table class="table custom table-bordered table-striped table-centered">
          <thead>
               <tr>
                    <th>S.No</th>
                    <th>Order By</th>
                    <th>Name</th>
                    <th>Status</th>
               </tr>
          </thead>
          <tbody id="orderTable">
               @foreach ($table_orders as $key =>  $row)
                    <tr>
                         <td scope="row">{{ $row->id }}</td>
                         <td width="200px">
                              <input type="number" id="col_{{ $row->id }}" class="form-control form-control-sm" onkeyup="changeOrder({{  $row->id }},'order_by')" value="{{ $row->order_by }}">
                         </td>
                         <td>{{ str_replace( '_'  , ' ',  ucfirst($row->column) ) }}</td>
                         <td>
                              <select class="form-select" id="status_{{ $row->id }}" onchange="changeOrder({{  $row->id }} , 'status')">
                                   <option {{ $row->status === 0 ? "selected" : null }} value="0">OFF</option>
                                   <option {{ $row->status === 1 ? "selected" : null }} value="1">ON</option>
                              </select>
                         </td>
                    </tr>
               @endforeach
          </tbody>
     </table>
     {!! $table_orders->links() !!}
@endsection
@section('scripts')
     <script>
          changeOrder    = (id) => {
               const data = {
                    id        : id,
                    order_by  : $(`#col_${id}`).val(),
                    status    : $(`#status_${id}`).val()
               }
               console.log($(`#status_${id}`).val())
               fetch('{{ route("table-order.store") }}', {
                    headers   : {
                         'Content-Type'  :  'application/json',
                         'X-CSRF-TOKEN'  :  $('meta[name="csrf-token"]').attr('content')
                    },
                    method    : 'POST',
                    body      : JSON.stringify(data)
               });
          }
     </script>
@endsection