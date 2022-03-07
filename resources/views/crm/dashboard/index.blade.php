@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('withdrawal-material-products') }}" class="card-body btn">
                    <i class="text-warning bi bi-aspect-ratio fa-2x mb-2"></i>
                    <h5 class="m-0 ">Withdrawal</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('list-material-products') }}" class="card-body btn">
                    <i class="text-warning bi bi-plus-circle-dotted fa-2x mb-2"></i>
                    <h5 class="m-0 ">Search or Add</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route("threshold-qty") }}" class="card-body btn">
                    <i class="text-warning bi bi-subtract fa-2x mb-2"></i>
                    <h5 class="m-0 ">Threshold Qty</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route("near-expiry-expired") }}" class="card-body btn">
                    <i class="text-warning bi bi-list-ul fa-2x mb-2"></i>
                    <h5 class="m-0 ">Near Expiry/Expired</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('disposal') }}" class="card-body btn">
                    <i class="text-warning bi bi-trash2 fa-2x mb-2"></i>
                    <h5 class="m-0 ">Early Disposal</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('extend-expiry') }}" class="card-body btn">
                    <i class="text-warning bi bi-arrow-up-right-square fa-2x mb-2"></i>
                    <h5 class="m-0 ">Extend Expiry</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('reports') }}" class="card-body btn">
                    <i class="text-warning bi bi-file-earmark-bar-graph fa-2x mb-2"></i>
                    <h5 class="m-0 ">Report</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('print-barcode') }}" class="card-body btn">
                    <i class="text-warning bi bi-upc-scan fa-2x mb-2"></i>
                    <h5 class="m-0 ">Print Barcode</h5>
                </a>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="card shadow-hover animate__animated animate__fadeIn">
                <a href="{{ route('reconsolidation') }}" class="card-body btn">
                    <i class="text-warning bi bi-arrow-repeat fa-2x mb-2"></i>
                    <h5 class="m-0 ">Reconciliation</h5>
                </a>
            </div>
        </div>  
    </div>
@endsection


