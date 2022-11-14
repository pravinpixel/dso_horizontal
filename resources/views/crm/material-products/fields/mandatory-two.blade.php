<div class="row m-0">
    <div class="col-md-8">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Storage area <sup class="text-danger">*</sup></label>
            <div class="col-8">
               {!! Form::select('storage_area', $storage_room_db , is_reset('storage_area', $batch->storage_area ?? null , category_type() ?? $material_product->category_selection ?? null), ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
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
                    'nil' =>'Nil',
                ] , $batch->housing ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required', 
                    config(is_disable(category_type() ?? $material_product->category_selection ?? null)."housing.status")
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
      
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4">Date in <sup class="text-danger">*</sup></label>
            <div class="col-8">
                {!! Form::date('date_in', $batch->date_in ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required', 
                    "onchange" => "validateDate('date_of_expiry', this)",
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
                    {!! Form::file('iqc_result',  [
                        'class'       => 'form-control form-control-sm border-0',
                        'placeholder' => 'Type here...',
                        'id' => "iqc_status_input",
                        $batch->iqc_result == null ? $batch->iqc_result_status != "on" ? 'required' : null : '',
                        config(is_disable(category_type() ?? $material_product->category_selection ?? null)."iqc_result.status") ,
                    ]) !!}
                    <span class="btn btn-light btn-sm border-start"> 
                        <input type="checkbox" name="iqc_result_status" id="iqc_result_check_box"
                            class="form-check-input"
                                @if ($material_product->Batches[0]->iqc_result == null)
                                    {{ $batch->iqc_result_status == "on" ? 'checked' : null }} 
                                @endif 
                                {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."iqc_result.status") }}
                            onclick="change_iqc_result_status()" 
                        />
                    </span>
                </div>
                @if ($batch->iqc_result)
                    <button onclick="download('{{ $batch->id }}','iqc_result')" class="badge bg-warning rounded-pill text-dark ms-1 border-0" type="button" >
                        <i class="fa fa-download me-1"></i>Download
                    </button> 
                @endif
                <small class="float-end"><i>Visual check done</i></small>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-0">
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4 mb-2">Owners  <sup class="text-danger">*</sup></label>
            <div class="col-12">
               
                @php
                    $owner_users = \Arr::pluck($batch->BatchOwners->toArray(), 'user_id')
                @endphp

                <select class="owners_select" name="owners[]" required multiple="multiple" {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."owner_one.status") }}>
                    @foreach ($owners as $id => $owner) 
                        <option  {{ in_array($id, $owner_users) ? "selected" : ""}}   value="{{ $id }}">  {{ $owner }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row m-0 y-center my-2">
            <label for="" class="col-4 mb-2">Access <sup class="text-danger">*</sup></label>
            <div class="col-12"> 
                <input type="text" id="access_flag" class="position-absolute" style="opacity: 0" />
                <select name="access[]" multiple="multiple" id="multiple_access" class="form-select" {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."access.status") }}>
                    @foreach ($staff_by_department as $row)  
                        @if (count($row['list']) != 0)
                            <optgroup label="{{ $row['name']}} {{ count($row['list']) }}">
                                @foreach ($row['list'] as $staff) 
                                    <option 
                                        {{ $material_product_dropdown == null ? 'selected' : '' }}
                                        {{ in_array($staff->id, $material_product_dropdown ?? []) ? "selected" : ""}}  
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
            <label for="" class="col-12 mb-1">COC/COA/Mill Cert  <sup class="text-danger">*</sup></label>
            <div class="col-12"> 
                <div class="d-flex y-center border rounded p-0"> 
                    <input 
                        multiple
                        type="file" 
                        name="coc_coa_mill_cert[]" 
                        id="coc_coa_mill_cert_input"
                        class="form-control form-control-sm border-0 coc_coa_mill_cert_input" 
                        {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."coc_coa_mill_cert.status")  }}
                    />
                    <span class="btn btn-light btn-sm border-start {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."coc_coa_mill_cert.status") }}"> 
                        <input 
                            type="checkbox" 
                            class="form-check-input"
                            name="coc_coa_mill_cert_status" 
                            id="coc_coa_mill_cert_check_box" 
                            onclick="change_coc_coa_status()" 
                            {{ $batch->coc_coa_mill_cert_status == 'on' ? 'checked' : '' }}
                            {{ config(is_disable(category_type() ?? $material_product->category_selection ?? null)."coc_coa_mill_cert.status") }}
                        /> 
                    </span>
                </div>
                <small id="coc_coa_myList"></small>
                @if (!is_null($batch->BatchFiles))
                    <div class="d-flex flex-wrap">
                        @foreach ($batch->BatchFiles as $key => $cocfile) 
                            <div class="d-flex align-items-center border shadow-sm p-1 rounded me-1 mt-1">
                                <button onclick="download('{{ $cocfile->id }}','coc_coa_mill_cert')" class="badge bg-warning rounded-pill text-dark ms-1 border-0" type="button" >
                                    <i class="fa fa-download me-1"></i>Download
                                </button>
                                <i class="fa fa-times ms-1 text-danger bg-white rounded font-12" onclick="deleteFile('{{ $cocfile->id }}',this)" style="cursor: pointer"></i>
                            </div>
                        @endforeach
                    </div>
                @endif
                <small class="float-end"><i>Used for TD/Expt only</i></small>
            </div>
        </div>
    </div> 
</div>

@section('styles')
    <link rel="stylesheet" href="https://www.jquery-az.com/jquery/css/jquery.multiselect.css"> 
    <script src="{{ asset('public/asset/css/vendors/select2.min.css') }}"></script>    
@endsection

@section('scripts') 
    <script src="https://www.jquery-az.com/jquery/js/multiselect-checkbox/jquery.multiselect.js"></script>
    <script src="{{ asset('public/asset/js/vendors/select2.min.js') }}"></script>    
    <script src="https://www.jqueryscript.net/demo/multiple-file-upload-validation/jquery.MultiFile.js"></script>
    @if (config(is_disable(category_type() ?? $material_product->category_selection ?? null)."access.status") == 'disabled')
        <script>
            $(document).ready(()=>{
                $('.ms-options-wrap button').attr('style', 'background-color: #EEF2F7 !important;pointer-events:none  !important');
            })
        </script>
    @endif
    <script> 
        var authUserName = "{{ auth_user()->alias_name }}"
        $('.ownner_select').select2(); 
        $('.owners_select').select2({
            placeholder:"-- Choose a Owners --",
        });
       
        toggleCheckBox = (name) => {
            Object.entries(document.querySelectorAll(`.${name}`)).map((checkBox)=>{
                checkBox[1].toggleAttribute('checked')
            })
        }

        $('.coc_coa_mill_cert_input').MultiFile({
            list: '#coc_coa_myList',
            max  : 3,
            error: function (err) {
                if(typeof console != 'undefined')   console.log(err);
                swal({
                    text: err,
                    icon: "error",
                    buttons: { 
                        confirm: {
                            text: "Okay ",
                            value: true,
                            visible: true,
                            className: "btn btn-primary rounded-pill",
                            closeModal: true
                        }
                    },
                }) 
            },
            onFileSelect: function(element, value, master_element) {
                master_element.clone.attr('required', false)
            }
        });

        $('#multiple_access').multiselect({
            placeholder :   '-- Select --',
            search      :   false,
            selectAll   :   true,
            selectGroup :   true,
            disabled:true,
            onOptionClick : function( element, option ){
                if(element.value == '') {
                    $('#access_flag').attr('required', true)
                } else {
                    $('#access_flag').attr('required', false)
                }
            }
        });

        if($("#multiple_access").val() === null) {
            $('#access_flag').attr('required', true)
        }
         
        // multiple_access
        change_coc_coa_status = () => {
            const checkBox      =    $('#coc_coa_mill_cert_check_box')
            const formInput     =    $('.coc_coa_mill_cert_input')
            if( checkBox.is(":checked") == true ){
                formInput.prop('required', false)
                formInput.prop('disabled', true)
            } else {
                formInput.prop('required', true)
                formInput.prop('disabled', false)
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

        const checkBox      =    $('#coc_coa_mill_cert_check_box')
        const formInput     =    $('input#coc_coa_mill_cert_input')
      
        if( checkBox.is(":checked") == true ){
            formInput.prop('required', false)
            formInput.prop('disabled', true)
        } else {
            formInput.prop('required', true)
            formInput.prop('disabled', false)
        }  
        deleteFile = (batch_id, element) => {
            const AppUrl = "{{ url('/') }}"
            fetch(`${AppUrl}/delete-file/${batch_id}`).then((res) =>res.json()).then((data) => {
                element.parentNode.classList.add('d-none')
            })
        } 
    </script>
    @if (!is_null($batch->BatchFiles)) 
        <script>
            $('input#coc_coa_mill_cert_input').prop('required', false)
        </script>
    @endif
@endsection