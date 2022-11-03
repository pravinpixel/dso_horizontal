@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::open(['route' => 'role.store',"id" => "roleForm", "Method" => "POST"]) !!}
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Role Name</label>
                <div class="col-8 ">
                    <div class="input-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div>
            </div>
            @include('masters.role.fields')
            <div class="text-end">
                <a href="{{ route('role.index') }}" class="btn btn-light me-2">Back</a>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 