@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('withdrawal-material-products') }}" class="card-body btn">
                    <i class="text-primary fa fa-briefcase fa-2x mb-2"></i>
                    <h5 class="m-0 ">Withdraw Material/ Product</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route("list-material-products") }}" class="card-body btn">
                    <i class="text-primary fa fa-list fa-2x mb-2"></i>
                    <h5 class="m-0 ">List Material/Product</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-file-text fa-2x mb-2"></i>
                    <h5 class="m-0 ">Report</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-bell fa-2x mb-2"></i>
                    <h5 class="m-0 ">Notification</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-search fa-2x mb-2"></i>
                    <h5 class="m-0 ">List Search</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-bitbucket fa-2x mb-2"></i>
                    <h5 class="m-0 ">Disposal</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-exclamation-circle fa-2x mb-2"></i>
                    <h5 class="m-0 ">Expired Materials</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-repeat fa-2x mb-2 "></i>
                    <h5 class="m-0 ">Reconsolidation</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="#" class="card-body btn">
                    <i class="text-primary fa fa-external-link-square fa-2x mb-2"></i>
                    <h5 class="m-0 ">Extend Expiry</h5>
                </a>
            </div>
        </div> 
    </div>
@endsection