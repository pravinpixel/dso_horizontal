<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Title <sup class="text-danger">*</sup></label>
    <div class="col-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off' , "required"]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Descriptions <sup class="text-danger">*</sup></label>
    <div class="col-10">
        {!! Form::textArea('description', null, ['class' => 'form-control' , "required"]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Attachments</label>
    <div class="col-10">
        {!! Form::file('attachments', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
        <br> 
        @if (isset($data->attachments))
            <iframe width="250px" height="250px" src="{{ url("storage/app")."/".$data->attachments  }}" frameborder="0"></iframe>
        @endif
    </div>
</div>