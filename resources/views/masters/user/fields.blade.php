<div class="row mb-3">
    <label class="col-2 text-end col-form-label">User ID / Login ID</label>
    <div class="col-10">
        {!! Form::number('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">First Name</label>
    <div class="col-10">
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Last Name</label>
    <div class="col-10">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Role</label>
    <div class="col-10">
        {!! Form::select('role_id',$roleDb , $userRole, ['class' =>'form-control', 'placeholder' => '-- Select Role --'])  !!}
    </div>
</div>