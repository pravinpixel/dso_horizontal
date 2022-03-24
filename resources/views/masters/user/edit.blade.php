@extends('masters.index')

@section('masters')

<div class="card">
    <div class="card-body">
        {!! Form::model($user,['route' => ['user.update', $user->id], 'id' => 'role_user_form', 'method'=> 'put']) !!}
            @include('masters.user.fields')
            <div class="row ">
                <div class="col-10 offset-2">
                    <a href="{{ route('user.index') }}" class="btn btn-light">back</a>
                    <button type="submit" class="btn btn-primary fw-bold">Update</button>
                </div>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 