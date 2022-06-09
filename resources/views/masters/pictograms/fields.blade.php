<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Name</label>
    <div class="col-10">
        {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
    </div>
</div> 
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Image</label>
    <div class="col-10">
        {!! Form::file('image', ['class' => 'form-control', 'required']) !!}
    </div>
</div>