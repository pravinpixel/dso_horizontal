<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Storage Room <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('storage_room', $storage_room_db , $material_product->storage_room ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Housing type <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('house_type', $house_type_db , $material_product->house_type ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Owner 1  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('owner_one', $owners , $material_product->owner_one ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Owner 2 (SE/PL/FM) <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('owner_two', $owners , $material_product->owner_two ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Dept <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('department', $departments_db , $material_product->department ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Access </label>
        <div class="col-8">
            <select name="access[]" multiple="multiple" id="multiple_access" class="form-select">
                <option>All</option>
                @foreach ($staff_by_department as $row) 
                    <optgroup label="{{ $row['name']}}">
                        @foreach ($row['list'] as $staff) 
                            <option 
                                {{ in_array( $staff->id, $material_product_dropdown ?? []) ? "selected" : ""}} 
                                {{ in_array("All", $material_product_dropdown ?? []) ? "selected" : ""}}
                                value="{{ $staff->id }}">
                               {{ $staff->alias_name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Date in <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::date('date_in', $material_product->date_in ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Date of expiry  <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::date('date_of_expiry', $material_product->date_of_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Upload SDS/Mill Cert Document  <sup class="text-danger">*</sup></label>
        <div class="col-8"> 
            {!! Form::hidden('sds_mill_cert_document_URL' , $material_product->sds_mill_cert_document ?? null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...',]) !!}
            {!! Form::file('sds_mill_cert_document' , ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...',]) !!}
        </div>
    </div>
</div>

<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">COC/COA/Mill Cert  <sup class="text-danger">*</sup></label>
        <div class="col-8 ">
            <div class="d-flex y-center border rounded p-0">
                {!! Form::hidden('coc_coa_mill_cert_document_URL' , $material_product->coc_coa_mill_cert_document ?? null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...',]) !!}
                {!! Form::file('coc_coa_mill_cert_document', ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...']) !!}
                <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">IQC status <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('iqc_status', $iqc_status , $material_product->iqc_status ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">IQC result<sup class="text-danger">*</sup></label>
        <div class="col-8 ">
            <div class="d-flex y-center border rounded p-0">
                {!! Form::hidden('iqc_result_URL' , $material_product->iqc_result ?? null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...',]) !!}
                {!! Form::file('iqc_result',  ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...']) !!}
                <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
            </div>
        </div>
    </div>
</div> 

@section('styles')
    <link rel="stylesheet" href="https://www.jquery-az.com/jquery/css/jquery.multiselect.css">
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
    <script src="https://www.jquery-az.com/jquery/js/multiselect-checkbox/jquery.multiselect.js"></script>
    <script>
        $('#multiple_access').multiselect({
            placeholder: '-- Select --'
        });
    </script>
@endsection