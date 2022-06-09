@extends('masters.index')

@section('masters')

<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'pictogram.store', 'id' => 'role_user_form', 'method'=> 'post' , 'files'=>true]) !!}
            @include('masters.pictograms.fields')
            <div class="row ">
                <div class="col-10 offset-2">
                    <a href="{{ route('pictogram.index') }}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary fw-bold">Save</button>
                </div>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 