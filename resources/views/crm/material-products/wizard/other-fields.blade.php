@extends('crm.material-products.add')
@section('wizzard-form-content')
{!! Form::open(['route' => ['create.material-product',['type' => 'form-four']], 'id' => 'create_other_form', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.other-fields')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('non-mandatory-form') }}" class="btn btn-light rounded-pill shadow-sm border">
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