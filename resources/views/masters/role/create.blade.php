@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::open(['route' => 'role.store',"id" => "roleForm", "Method" => "POST"]) !!}
            @include('masters.role.fields')
            <div class="text-end">
                <a href="{{ route('role.index') }}" class="btn btn-light me-2">back</a>
                <button type="submit" class="btn btn-primary fw-bold">Save</button>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 