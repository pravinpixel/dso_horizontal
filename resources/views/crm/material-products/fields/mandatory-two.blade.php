<div class="row m-0">
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Storage area <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('storage_area', $storage_room_db , $batch->storage_area ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."storage_area.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Housing type <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('housing_type', $house_type_db , $batch->housing_type ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."housing_type.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
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
                    'Nil' =>'Nil',
                ] , $batch->housing ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."housing.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Owner 1  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('owner_one', $owners , $batch->owner_one ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."owner_one.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Owner 2 (SE/PL/FM) <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('owner_two', $owners , $batch->owner_two ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."owner_two.status")
                ])  !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Department <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('department', $departments_db , $batch->department ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."department.status")
                ])  !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Access <sup class="text-danger">*</sup></label>
            <div class="col-8">
                <select name="access[]" @if (config(is_disable(category_type() ?? $material_product->category_selection)."access.status") != 'disabled')
                    multiple="multiple" id="multiple_access"
                    @endif  
                    class="form-select" {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."access.status") }}>
                    @foreach ($staff_by_department as $row)  
                        @if (count($row['list']) != 0)
                            <optgroup label="{{ $row['name']}} {{ count($row['list']) }}">
                                @foreach ($row['list'] as $staff) 
                                    <option 
                                        {{ in_array($staff->id, $material_product_dropdown ?? []) ? "selected" : ""}} 
                                        {{ in_array("All", $material_product_dropdown ?? []) ? "selected" : ""}}
                                        {{-- {{ is_select() }} --}}
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
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Date in <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::date('date_in', $batch->date_in ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."date_in.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Date of expiry  <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::date('date_of_expiry', $batch->date_of_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."date_of_expiry.status")
                ]) !!}
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">COC/COA/Mill Cert  <sup class="text-danger">*</sup></label>
            <div class="col-8 ">
                <div class="d-flex y-center border rounded p-0">
                    {!! Form::file('coc_coa_mill_cert', ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...', "id"=>"coc_coa_mill_cert_input",
                        $batch->coc_coa_mill_cert_status != "on" ? 'required' : null ,
                        config(is_disable(category_type() ?? $material_product->category_selection ?? null)."coc_coa_mill_cert.status")
                    ]) !!}
                    {!! isset($material_product->Batches[0]->coc_coa_mill_cert) ? "<i class='fa fa-check-circle me-2 fa-1x text-success'></i> " : "" !!} 

                    @if (wizard_mode() == 'duplicate')
                        <span class="btn btn-light btn-sm border-start"> 
                            <input type="checkbox" 
                                @if ($material_product->Batches[0]->coc_coa_mill_cert == null)
                                    {{ $batch->coc_coa_mill_cert_status == "on" ? 'checked' : null }} 
                                @endif
                                name="coc_coa_mill_cert_status" id="coc_coa_mill_cert_check_box"
                                class="form-check-input"  
                                {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."coc_coa_mill_cert.status") }}
                            onclick="change_coc_coa_status()">
                        </span>
                        @else
                        <span class="btn btn-light btn-sm border-start"> 
                            <input type="checkbox" 
                            @if ($material_product->Batches[0]->coc_coa_mill_cert == null)
                                {{ $batch->coc_coa_mill_cert_status == "on" ? 'checked' : null }} 
                            @endif
                            name="coc_coa_mill_cert_status" id="coc_coa_mill_cert_check_box"
                            class="form-check-input" 
                            {{ isset($material_product->Batches[0]->coc_coa_mill_cert) ? 'disabled' : null}}
                            {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."coc_coa_mill_cert.status") }}
                            onclick="change_coc_coa_status()">
                        </span>
                    @endif 
                </div>
                @if ($batch->coc_coa_mill_cert)
                    <a href="{{ storageGet($batch->coc_coa_mill_cert) }}" download="{{ storageGet($batch->coc_coa_mill_cert) }}">
                        <i class="fa fa-download"></i> <small>{{ substr(str_replace('public/files/coc_coa_mill_cert/','' ,$batch->coc_coa_mill_cert),0,20) }}</small>
                    </a>
                @endif
                <small class="float-end"><i>Used for TD/Expt only</i></small>
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">IQC status  (P/F)<sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::select('iqc_status', $iqc_status , $batch->iqc_status ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."iqc_status.status")
                ])  !!} 
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">IQC result<sup class="text-danger">*</sup></label>
            <div class="col-8 ">
                <div class="d-flex y-center border rounded p-0">
                    {!! Form::file('iqc_result',  ['class' => 'form-control form-control-sm border-0', 'placeholder' => 'Type here...', 
                        $batch->iqc_result_status != "on" ? 'required' : null,
                        config(is_disable(category_type() ?? $material_product->category_selection ?? null)."iqc_result.status") ,
                        "id" => "iqc_status_input"
                    ]) !!}
                    {!! isset($material_product->Batches[0]->iqc_result) ? "<i class='fa fa-check-circle me-2 fa-1x text-success'></i> " : null !!} 
                    <span class="btn btn-light btn-sm border-start"> 
                        <input type="checkbox" 
                        @if ($material_product->Batches[0]->iqc_result == null)
                            {{ $batch->iqc_result_status == "on" ? 'checked' : null }} 
                        @endif
                        {{ isset($material_product->Batches[0]->iqc_result) ? 'disabled' : null}}
                        name="iqc_result_status" id="iqc_result_check_box"
                        class="form-check-input" 
                        {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."iqc_result.status") }}
                        onclick="change_iqc_result_status()">
                    </span> 
                </div>
                @if ($batch->iqc_result)
                    <a href="{{ storageGet($batch->iqc_result) }}" download="{{ storageGet($batch->iqc_result) }}">
                        <i class="fa fa-download"></i> <small>{{ substr(str_replace('public/files/iqc_result/','' ,$batch->iqc_result),0,20) }}</small>
                    </a>
                @endif
                
                <small class="float-end"><i>Visual check done</i></small>
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
            placeholder :   '-- Select --',
            search      :   true,
            selectAll   :   true,
            selectGroup :   true,
        }); 
        change_coc_coa_status = () => {
            const checkBox      =    $('#coc_coa_mill_cert_check_box')
            const formInput     =    $('#coc_coa_mill_cert_input')
            if( checkBox.is(":checked") == true ){
                formInput.prop('required', false)
            } else {
                formInput.prop('required', true)
            }
        }
        change_iqc_result_status = () => {
            const checkBox      =    $('#iqc_result_check_box')
            const formInput     =    $('#iqc_status_input')
            if( checkBox.is(":checked") == true ){
                formInput.prop('required', false)
            } else {
                formInput.prop('required', true)
            }
        }
    </script>
@endsection