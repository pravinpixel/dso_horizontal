@extends('masters.index')

@section('masters')

<div class="card">
    <div class="card-body">
        {!! Form::model($data,['route' => ['pictogram.update', $data->id], 'id' => 'role_user_form', 'method'=> 'put','files'=>true]) !!}
            @include('masters.pictograms.fields')
            <div class="row ">
                <div class="col-10 offset-2">
                    <a href="{{ route('pictogram.index') }}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary fw-bold">Update</button>
                </div>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 