@extends('crm.reports.index')
 
@section('report_content')  
    @if (count($product_batches) != 0) 
        <div class="card card-body">
            <table class="table pt-2" id="custom-data-table">
                <thead>
                    <tr>
                        <th class="text-white bg-primary-2 text-center">S.No</th>
                        <th class="text-white bg-primary-2 text-center">Transaction date </th>
                        <th class="text-white bg-primary-2 text-center">Transaction time </th>
                        <th class="text-white bg-primary-2 text-center">Transaction By </th>
                        <th class="text-white bg-primary-2 text-center">Module </th>
                        <th class="text-white bg-primary-2 text-center">Action Taken </th>
                        <th class="text-white bg-primary-2 text-center">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_batches as $i => $row)
                        <tr>
                            <td class="text-center py-1">{{ $i+1 }}</td>
                            <td class="text-center py-1">{{ $row->created_at->format('Y-m-d') }} </td>
                            <td class="text-center py-1">{{ $row->created_at->format('h:m A') }} </td>
                            <td class="text-center py-1">{{ $row->User->alias_name }} </td>
                            <td class="text-center py-1">{{ $row->module_name }} </td>
                            <td class="text-center py-1">{{ $row->action_type }} </td>
                            <td class="text-center py-1">{{ $row->remarks != null && $row->remarks != '' ? $row->remarks : '-'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
        @else
       {!! no_data_found() !!}
    @endif
@endsection
 
@section('scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('public/asset/js/vendors/datatable-btns.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="{{ asset('public/asset/js/vendors/datatable-btn-html.js') }}"></script> 
    <script>
        $(document).ready(function () {
            $('#custom-data-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv'
                ]
            });
        });
    </script>
@endsection