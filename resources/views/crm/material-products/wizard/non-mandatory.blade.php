@extends('crm.material-products.add')
@section('wizzard-form-content')
{!! Form::open(['route' => 'non-mandatory-form', 'id' => 'wizzard_non_mandatory_form', 'class' => 'row', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.non-mandatory')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('mandatory-form-two') }}" class="btn btn-light rounded-pill shadow-sm border">
            <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
        </a>
        <button class="btn btn-primary float-end rounded-pill" type="submit" >
            <b><i class="bi bi-check-circle mse-1"></i> Submit & Save</b>
        </button>  
    </div>
{!! Form::close() !!}
@endsection