@extends('crm.material-products.add')
@section('wizzard-form-content')
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Storage Room <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                    <option value=""> AR</option>
                    <option value=""> CW</option>
                    <option value=""> MA</option>
                    <option value=""> SP</option>
                    <option value=""> MR</option>
                    <option value=""> Polymer</option>
                    <option value=""> ChemShed1</option>
                    <option value=""> ChemShed2</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Housing type <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                    <option value=""> Flammable</option>
                    <option value=""> Cabinet</option>
                    <option value=""> Acid Cabinet</option>
                    <option value=""> Base Cabinet</option>
                    <option value=""> Metal Cabinet</option>
                    <option value=""> Racks</option>
                    <option value=""> Dry Cabinet</option>
                    <option value=""> Freezer</option>
                    <option value=""> Pallet</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Owner 1  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                    <option value=""> Staff A</option> 
                    <option value=""> Staff B</option> 
                    <option value=""> Staff C</option> 
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Owner 2 (SE/PL/FM) <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                    <option value=""> Staff A</option> 
                    <option value=""> Staff B</option> 
                    <option value=""> Staff C</option> 
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Dept <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                    <option value=""> EGP1</option>
                    <option value="">EGP4</option>
                    <option value="">EGP7</option>
                    <option value="">FSML</option>
                    <option value="">STML</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Access </label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value=""> Staff A</option> 
                    <option value=""> Staff B</option> 
                    <option value=""> Staff C</option> 
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Date in <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="date" name="" id="" class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Date of expiry  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="date" name="" id="" class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Upload SDS/Mill Cert Document  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="file" name="" id="" class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">COC/COA/Mill Cert  <sup class="text-danger">*</sup></label>
            <div class="col-8 ">
                <div class="d-flex y-center border rounded p-0">
                    <input type="file" name="" id="" class="form-control form-control-sm border-0">
                    <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">IQC status <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value=""> -- select --</option> 
                    <option value=""> Pass</option> 
                    <option value=""> Fail</option> 
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">IQC result<sup class="text-danger">*</sup></label>
            <div class="col-8 ">
                <div class="d-flex y-center border rounded p-0">
                    <input type="file" name="" id="" class="form-control form-control-sm border-0">
                    <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
                </div>
            </div>
        </div>
    </div>
@endsection