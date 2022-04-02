<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Title</label>
    <div class="col-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Descriptions</label>
    <div class="col-10">
        {!! Form::textArea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Attachments </label>
    <div class="col-10">
        {!! Form::file('attachments', ['class' => 'form-control',]) !!} 
    </div>
</div>