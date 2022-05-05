@extends('crm.material-products.duplicate')
@section('wizzard-form-content')
{!! Form::model($material_product, ['route' => ['edit_or_duplicate.material-product', "wizard_mode"=>'duplicate',"type" => 'form-three' , "id" => $material_product->id , "batch_id" => $batch_id ], 'id' => 'wizzard_non_mandatory_form', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.non-mandatory')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'duplicate',"type" => 'form-two' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="btn btn-light rounded-pill shadow-sm border">
            <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
        </a>
        <button type="submit" class="btn btn-primary rounded-pill float-end shadow-sm border">
            <b>Next <i class="bi bi-arrow-right-circle ms-1"></i> </b>
        </button>
    </div>
{!! Form::close() !!}
@endsection