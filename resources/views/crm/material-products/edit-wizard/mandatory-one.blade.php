@extends('crm.material-products.edit')
@section('wizzard-form-content')

    {!! Form::model($material_product, ['route' => ['edit_or_duplicate.material-product', "wizard_mode" => "edit", "type" => 'form-one' , "id" => $material_product->id , "batch_id" => $batch_id , "is_parent" =>  is_parent() ], 'id' => 'wizzard_form_one', 'class' => 'row wizzard-form', 'method'=> 'post']) !!}
        <div class="card-body row">
            @include('crm.material-products.fields.mandatory-one')
        </div>
        <div class="card-footer border-top bg-light"> 
            <button class="btn btn-primary float-end rounded-pill" type="submit" >
                <b>Next <i class="bi bi-arrow-right-circle ms-1"></i></b>
            </button>
        </div>
    {!! Form::close() !!}  
@endsection 
 