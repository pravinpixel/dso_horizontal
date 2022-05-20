@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::model($role, ['route' => ['role.update',$role->id],"id" => "roleForm", 'method'=> 'put']) !!}
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