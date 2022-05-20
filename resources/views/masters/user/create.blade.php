@extends('masters.index')

@section('masters')

<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'user.store', 'id' => 'role_user_form', 'method'=> 'post']) !!}
            @include('masters.user.fields')
            <div class="row ">
                <div class="col-10 offset-2">
                    <a href="{{ route('user.index') }}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary fw-bold">Save</button>
                </div>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 