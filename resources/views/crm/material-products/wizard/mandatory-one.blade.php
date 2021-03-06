@extends('crm.material-products.add')
@section('wizzard-form-content')
    {!! Form::open(['route' => ['create.material-product',['type' => 'form-one']], 'id' => 'wizzard_form_one', 'class' => 'row wizzard-form', 'method'=> 'post']) !!}
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