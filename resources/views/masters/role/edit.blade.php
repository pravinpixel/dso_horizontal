@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::model($role, ['route' => ['role.update',$role->id],"id" => "roleForm", 'method'=> 'put']) !!}
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
            <div class="row ">
                <div class="col-10 offset-2">
                    <a href="{{ route('role.index') }}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary fw-bold">Update</button>
                </div>
            </div> 
        {!! Form::close() !!}
    </div>
</div>
@endsection 