<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended expiry</label>
        <div class="col-8">
            {!! Form::text('extended_expiry', $batch->extended_expiry ?? null, ['class' => 'form-control form-select-sm', 'placeholder' => 'Type here...', 'required', in_house_type()]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended QC status</label>
        <div class="col-8">
           {!! Form::select('extended_qc_status', ['Fail','Pass'] , $batch->extended_qc_status ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required',in_house_type()])  !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Extended QC result</label>
        <div class="col-8 ">
            {!! Form::file('extended_qc_result', ['class' => 'form-control form-control-sm', 'placeholder' => 'Type here...']) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Disposal certificate</label>
        <div class="col-8"> 
            {!! Form::file('disposal_certificate', ['class' => 'form-control form-control-sm ', 'placeholder' => 'Type here...', in_house_type()]) !!}
        </div>
    </div>
</div>
<div class="col-lg-6 my-1">
    <div class="row m-0 y-center">
        <label for="" class="col-4">Used for TD/Expt only</label>
        <div class="col-8">
           {!! Form::select('used_for_td_expt_only', ['No','Yes'] , $batch->used_for_td_expt_only ?? null, ['class' =>'form-select form-select-sm', 'placeholder' => '-- Select --' , 'required',in_house_type()])  !!}
        </div>
    </div>
</div>
<div id="hidden_input"></div>