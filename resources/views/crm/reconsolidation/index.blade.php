@extends('layouts.app')
@section('content')
        
    <div class="d-flex align-items-center mb-3">
        <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
            <div class="input-group align-items-center" title="Scan Barcode">
                <i class="bi bi-upc-scan font-20 mx-2"></i>
                <input type="text" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
            </div> 
        </div>
    </div>
   
    <div class="table-fillters row m-0 p-2">
        <div class="col-12 mb-2 text-end">
            <button  data-bs-toggle="modal" data-bs-target="#advance-search-modal"  class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
        </div>
        <div class="col">
            <label for="" class="form-label">Material/Product description</label>
            <input type="text" class="form-control custom" placeholder="Type here...">
        </div> 
        <div class="col">
            <label for="" class="form-label">Brand</label>
            <input type="text" class="form-control custom" placeholder="Type here...">
        </div> 
        <div class="col">
            <label for="" class="form-label">Owner 1/2</label>
            <select name="" id="" class="form-select custom">
                <option value="">-- select --</option>
                <option value="1">Vetri maran</option>
                <option value="2">Alan walker</option>
                <option value="3">Alex</option>
                <option value="4">Hema</option>
            </select>
        </div> 
        <div class="col">
            <label for="" class="form-label">Dept</label>
            <select name="" id="" class="form-select custom">
                <option value="">-- select --</option>
                <option value="1">EGP1</option>
                <option value="2">EGP4</option>
                <option value="3">EGP7</option>
                <option value="4">FSML</option>
                <option value="4">STML</option>
            </select>
        </div> 
        <div class="col">
            <label for="" class="form-label">Storage area</label>
            <select name="" id="" class="form-select custom">
                <option value="">-- select --</option>
                <option value="1">AR</option>
                <option value="2">CW</option>
                <option value="3">MA</option>
                <option value="4">SP</option>
                <option value="4">MR</option>
                <option value="4">Polymer</option>
                <option value="4">ChemShed1</option>
                <option value="4">ChemShed2</option>
            </select>
        </div> 
        <div class="col">
            <label for="" class="form-label">Housing type</label>
            <input type="text" class="form-control custom" placeholder="Type here...">
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <div class="btn-group">
                <button class="btn btn-sm btn-primary rounded w-100 h-100 me-2"><i class="bi bi-search"></i></i> </button>
                <button class="btn btn-sm btn-light w-100 h-100 rounded"><i class="bi bi-arrow-counterclockwise"></i></button>
            </div>
        </div> 
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="table-th text-center">S.No</th>
                     <th class="table-th child-td-lg"> Item Description</th>
                    <th class="table-th child-td child-td-lg">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt size</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage location </th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td text-danger">Count</th>
                </tr> 
            </thead>
            @for ($key=0; $key<2; $key++)
            <tr>
                <td class="child-td">{{ $key+1 }}</td>
                <td class="child-td-lg">Acetone IND</td>
                <td class="child-td child-td-lg">Sigma Aldrich</td>
                <td class="child-td">XYZ/-/4567</td>
                <td class="child-td">{{ $key+1 }}</td>
                <td class="child-td child-td-lg">Junxiang/Joon Fatt</td>
                <td class="child-td">MR</td>
                <td class="child-td">FC2</td>
                <td class="child-td">09/0{{ $key+1 }}/21</td>
                <td class="child-td text-danger">1>2>3</td>
            </tr>
            @endfor
        </table> 
    </div> 
@endsection