<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Storage area <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('storage_room', $storage_room_db , $material_product->storage_room ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Housing type <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('housing_type', $house_type_db , $material_product->housing_type ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Housing # <sup class="text-danger">*</sup></label>
        <div class="col-8">
            {!! Form::select('housing', [
                '1' => '1' ,
                '2' => '2' ,
                '3' => '3' ,
                '4' => '4' ,
                '5' => '5' ,
                '6' => '6' ,
                '7' => '7' ,
                '8' => '8' ,
                '9' => '9' ,
                '10' =>'10',
                '11' =>'11',
                '12' =>'12',
                '13' =>'13',
                '14' =>'14',
                '15' =>'15',
                '16' =>'16',
                '17' =>'17',
                '18' =>'18',
                '19' =>'19',
                '20' =>'20',
            ] , $material_product->housing ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required'])  !!}
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
        <label for="" class="col-4">Access <sup class="text-danger">*</sup></label>
        <div class="col-8">
            <select name="access[]" multiple="multiple" id="multiple_access" class="form-select">
                @foreach ($staff_by_department as $row)  
                    @if (count($row['list']) != 0)
                        <optgroup label="{{ $row['name']}} {{ count($row['list']) }}">
                            @foreach ($row['list'] as $staff) 
                                <option 
                                    {{ in_array( $staff->id, $material_product_dropdown ?? []) ? "selected" : ""}} 
                                    {{ in_array("All", $material_product_dropdown ?? []) ? "selected" : ""}}
                                    value="{{ $staff->id }}">
                                    {{ $staff->alias_name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endif 
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
        <label for="" class="col-4">COC/COA/Mill Cert  <sup class="text-danger">*</sup></label>
        <div class="col-8 ">
            <div class="d-flex y-center border rounded p-0">
                {!! Form::file('coc_coa_mill_cert', ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...']) !!}
                <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
            </div>
            <small class="float-end"><i>Used for TD/Expt only</i></small>
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
                {!! Form::file('iqc_result',  ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...']) !!}
                <span class="btn btn-light btn-sm border-start"><input type="checkbox" name="" id="" class="form-check-input"></span>
            </div>
            <small class="float-end"><i>Visual check done</i></small>
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
            placeholder: '-- Select --',
            search: true,
            selectAll:true,
            selectGroup : true,
        });
    </script>
@endsection