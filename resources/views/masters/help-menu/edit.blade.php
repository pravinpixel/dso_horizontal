@extends('masters.index')

@section('masters')
<div class="card">
    <div class="card-body">  
        {!! Form::model($data, ['route' => ['help.menu.update', $data->id],"id" => "helpForm", "Method" => "PUT",'files'=>true]) !!}
            @include('masters.help-menu.fields')
            <div class="text-end">
                <a href="{{ route('help.menu.index') }}" class="btn btn-light me-2">back</a>
                <button type="submit" class="btn btn-primary fw-bold">Save</button>
            </div> 
        {!! Form::close() !!}
    </div>
</div> 
@endsection 