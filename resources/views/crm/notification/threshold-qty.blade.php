@extends('layouts.app')
@section('content')
    <div class="s">
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                     <th class="table-th child-td-lg"> Item Description</th>
                    <th class="table-th child-td">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage rm</th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">Threshold limit</th>
                    <th class="table-th child-td">Balance </th>
                    <th class="table-th child-td-lg">RecommendedAction</th>
                    <th class="table-th child-td">Read Status</th>
                </tr> 
            </thead>
            <tr class="table-tr">
                <td colspan="12" class="p-0 border-bottom">
                    <table class="table m-0">
                        <tr>
                            <td class="child-td-lg"><i class="bi bi-caret-right-fill collapsed table-toggle-icon" data-bs-toggle="collapse" href="#row1" role="button" aria-expanded="false" aria-controls="row1"></i> Acetone IND</td>
                            <td class="child-td">XOX</td>
                            <td class="child-td">- Batch1/001</td>
                            <td class="child-td-lg"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td text-center">10</td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td">/-</td>
                        </tr>
                        <tr class="collapse show" id="row1">
                            <td colspan="12" class="p-0">
                                <table class="table bg-white m-0">
                                    @for ($i=0;$i<6;$i++)
                                        <tr>
                                            <td class="child-td-lg"></td>
                                            <td class="child-td"></td>
                                            <td class="child-td">Batch1/-</td>
                                            <td class="child-td-lg">Keith/HuiBeng</td>
                                            <td class="child-td">CW</td>
                                            <td class="child-td">FC1</td>
                                            <td class="child-td"></td>
                                            <td class="child-td">8</td>
                                            <td class="child-td-lg">To replenish</td>
                                            <td class="child-td">-</td>
                                        </tr> 
                                    @endfor
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
        </table> 
    </div>         
@endsection 