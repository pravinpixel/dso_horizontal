@extends('layouts.app')
@section('content')
<div class="s">
    <table class="table table-bordered table-hover bg-white">
        <tr>
            <td class="table-th child-td">S.No</td>
            <td class="table-th child-td">Material / Product  Description</td>
            <td class="table-th child-td">Brand</td>
            <td class="table-th child-td">#Batch/Serial/Lot No</td>
            <td class="table-th child-td">Qty</td>
            <td class="table-th child-td">Owner 1/2</td>
            <td class="table-th child-td">Storage location</td>
            <td class="table-th child-td">Housing Type</td>
            <td class="table-th child-td">DOE</td>
            <td class="table-th child-td">Action</td>
        </tr>
        <tbody>
            @for ($i=0;$i<6;$i++)
                <tr>
                    <td class="child-td">{{ $i+1 }}</td>
                    <td class="child-td">IPA </td>
                    <td class="child-td">Sigma Aldrich</td>
                    <td class="child-td">ABC/-/1234</td>
                    <td class="child-td">{{ $i+1 }}0</td>
                    <td class="child-td">Junxiang/JoonFatt</td>
                    <td class="child-td">MR </td>
                    <td class="child-td">FC{{ $i+1 }}</td>
                    <td class="child-td">30/0{{ $i+1 }}/21</td>
                    <td class="child-td">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose</a>
                                <a class="dropdown-item" href="#"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
                            </div>
                        </div>
                    </td>
                </tr> 
            @endfor
        </tbody>
    </table> 
</div>     
@endsection 