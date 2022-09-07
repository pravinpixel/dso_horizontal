<div class="row mb-3">
    <label class="col-2 text-end col-form-label">User ID / Login ID</label>
    <div class="col-10">
        {!! Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Full Name</label>
    <div class="col-10">
        {!! Form::text('full_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Alias Name</label>
    <div class="col-10">
        {!! Form::text('alias_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Department</label>
    <div class="col-10">
        {!! Form::select('department',$departmentDb , $userDepartment, ['class' =>'form-select', 'placeholder' => '-- Select Role --'])  !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Role</label>
    <div class="col-10">
        {!! Form::select('role_id',$roleDb , $userRole, ['class' =>'form-select', 'placeholder' => '-- Select Role --'])  !!}
    </div>
</div>

