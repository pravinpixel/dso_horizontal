@extends('crm.material-products.edit')
@section('wizzard-form-content')
{!! Form::model($material_product,['route' => ['edit.material-product', "type" => 'form-two' , "id" => $material_product->id , "batch_id" => $batch_id ], 'id' => 'wizzard_form_two', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.mandatory-two')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('edit.material-product', ["type" => 'form-one' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="btn btn-light rounded-pill shadow-sm border">
            <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
        </a>
        <button class="btn btn-primary float-end rounded-pill" type="submit" >
            <b>Next <i class="bi bi-arrow-right-circle ms-1"></i></b>
        </button>  
    </div>
{!! Form::close() !!}
@endsection