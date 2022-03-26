@extends('crm.material-products.edit')
@section('wizzard-form-content')
{!! Form::open(['route' => ['edit-mandatory-form-three', $material_product->id], 'id' => 'wizzard_non_mandatory_form', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.non-mandatory')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('edit-mandatory-form-two', $material_product->id) }}" class="btn btn-light rounded-pill shadow-sm border">
            <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
        </a>
        <button class="btn btn-primary  bg-primary-2  float-end rounded-pill" type="submit" >
            <b><i class="bi bi-check-circle mse-1"></i> Submit & Save</b>
        </button>  
    </div>
{!! Form::close() !!}
@endsection