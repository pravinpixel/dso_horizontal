@extends('crm.material-products.add')
@section('wizzard-form-content')
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Category selection</label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                    <option value="">Material</option>
                    <option value="">In-house Product</option>
                </select>
            </div>
        </div>
    </div> 
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Item Description</label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">In-house Product Logsheet ID</label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Brand <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Supplier <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Unit Packing size <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option>
                                    <option value="1">kg</option>
                                    <option value="2">L</option>
                                    <option value="3">m</option>									
                                    <option value="4">m&#xB2;</option>
                                    <option value="4">piece</option>
                                    <option value="4">roll</option>
                                    <option value="4">drum</option>
                                    <option value="4">lnyard</option>
                </select>
            </div>
        </div>
    </div> 
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Quantity  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="number" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Batch #   <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Serial #   <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">PO Number  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Type here...">
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">Statutory body  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option> 
                    <option value=""> SCDF</option>
                    <option value=""> NEA</option>
                    <option value=""> HSA</option>
                    <option value=""> NA(CWC)</option>
                    <option value=""> SPF</option>
                    <option value=""> Not Applicable</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 my-1">
        <div class="row m-0 y-center">
            <label for="" class="col-4">EUC material  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="" id="" class="form-select form-select-sm">
                    <option value="">-- select --</option> 
                    <option value=""> Yes</option>
                    <option value=""> No</option> 
                </select>
            </div>
        </div>
    </div> 
@endsection 