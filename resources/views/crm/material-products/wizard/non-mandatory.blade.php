@extends('crm.material-products.add')
@section('wizzard-form-content')
{!! Form::open(['route' => 'non-mandatory-form', 'id' => 'wizzard_non_mandatory_form', 'onsubmit' => 'confirmPrint(event)', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.non-mandatory')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('mandatory-form-two') }}" class="btn btn-light rounded-pill shadow-sm border">
            <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
        </a>
        <div class="float-end">
            <button class="btn btn-secondary rounded-pill">
                <b><i class="bi bi-check-circle mse-1"></i> Save as Draft</b>
            </button> 
            <button class="btn btn-success rounded-pill" type="submit">
                <b><i class="bi bi-check-circle mse-1"></i> Submit & Save</b>
            </button> 
        </div> 
    </div>
{!! Form::close() !!}

@endsection
