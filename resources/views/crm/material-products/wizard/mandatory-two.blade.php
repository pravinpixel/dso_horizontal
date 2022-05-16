@extends('crm.material-products.add')
@section('wizzard-form-content')
{!! Form::open(['route' => ['create.material-product',['type' => 'form-two']], 'id' => 'wizzard_form_two', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
    <div class="card-body row">
        @include('crm.material-products.fields.mandatory-two')
    </div>
    <div class="card-footer border-top bg-light"> 
        <a href="{{ route('create.material-product',['type'=>'form-one']) }}" class="btn btn-light rounded-pill shadow-sm border">
            <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
        </a>
        <button class="btn btn-primary float-end rounded-pill" type="submit" >
            <b>Next <i class="bi bi-arrow-right-circle ms-1"></i></b>
        </button>  
    </div>
{!! Form::close() !!}
@endsection