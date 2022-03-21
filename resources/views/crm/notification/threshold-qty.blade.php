@extends('layouts.app')
@section('content')
    <div>
	 
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="table-th child-td-lg"> Item Description</th>
                    <th class="table-th child-td">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt Size</th>
                    <th class="table-th child-td">Qty</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage Room</th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">Threshold limit</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td">Read Status</th>
					 <th class="table-th child-td">Actions</th>
                </tr> 
            </thead>
			
            <tr class="table-tr">
                <td colspan="12" class="p-0 border-bottom">
                    <table class="table m-0">
                        <tr>
                            <td class="child-td-lg"><i class="bi bi-caret-right-fill collapsed table-toggle-icon" data-bs-toggle="collapse" href="#row1" role="button" aria-expanded="false" aria-controls="row1"></i> Acetone IND</td>
                            <td class="child-td">XOX</td>
                            <td class="child-td">- Batch1/001</td>
                            <td class="child-td"> 5</td>
                            <td class="child-td-lg"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td text-center">10</td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td">/-</td>
							<td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View batch details
                                        </a>                                        
                                    </div>
                                </div>
                            </td> 
                        </tr> 
                        <tr class="collapse show" id="row1">
                            <td colspan="12" class="p-0">
                                <table class="table bg-white m-0">
                                    @for ($i=0;$i<6;$i++)
                                        <tr>
                                            <td class="child-td-lg"></td>
                                            <td class="child-td"></td>
                                            <td class="child-td">Batch1/-</td>
                                            <td class="child-td">{{ $i+1 }}</td>
                                            <td class="child-td">8</td>
                                            <td class="child-td-lg">Keith/HuiBeng</td>
                                            <td class="child-td">CW</td>
                                            <td class="child-td">FC1</td>
                                            <td class="child-td"></td>
                                            <td class="child-td">10/02/2020</td>                                           
                                            <td class="child-td-lg">To replenish</td>
                                            <td class="child-td">
                                                <input type="checkbox" id="switch0_{{ $i+1 }}" data-switch="none"/>
                                                <label for="switch0_{{ $i+1 }}" data-on-label="" data-off-label=""></label>
                                            </td>
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