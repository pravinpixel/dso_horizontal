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
        <label style="color:red;">Please upload the image with 150 x 150 in dimension</label>
    </div>

</div>