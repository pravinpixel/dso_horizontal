@extends('crm.material-products.duplicate')
@section('wizzard-form-content')
    {!! Form::model($material_product, ['route' => ['edit_or_duplicate.material-product', "wizard_mode"=>'edit',"type" => 'form-four' , "id" => $material_product->id , "batch_id" => $batch_id ], 'id' => 'duplicate_other_form', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
        <div class="card-body row">
            @include('crm.material-products.fields.other-fields')
        </div>
        <div class="card-footer border-top bg-light"> 
            <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'duplicate',"type" => 'form-three' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="btn btn-light rounded-pill shadow-sm border">
                <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
            </a>
            <div class="float-end">
                <button class="btn btn-secondary rounded-pill" onclick="saveAsDraft(event)">
                    <b><i class="bi bi-check-circle mse-1"></i> Save as Draft</b>
                </button> 
                <button class="btn btn-success rounded-pill" onclick="submitAndSave(event)">
                    <b><i class="bi bi-check-circle mse-1"></i> Submit & Save</b>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
@endsection