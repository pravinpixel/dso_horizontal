@extends('layouts.app')
@section('content')
    <div class="row">
        <x-has-access name="reports.utilization-cart">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.utilization-cart') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Utilization Cart</b></div>
                    </a>
                </div>
            </div> 
        </x-has-access>
        <x-has-access name="reports.material_in_house_pdt_history">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.material_in_house_pdt_history') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Products History</b></div>
                    </a>
                </div>
            </div> 
        </x-has-access>
        <x-has-access name="reports.deduct_track_usage">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.deduct_track_usage') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Deduct Track Usage</b></div>
                    </a>
                </div>
            </div>  
        </x-has-access>
        <x-has-access name="reports.deduct_track_outlife">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.deduct_track_outlife') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Deduct Track Outlife</b></div>
                    </a>
                </div>
            </div>  
        </x-has-access>
        <x-has-access name="reports.disposed_items">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.disposed_items') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Disposed Items</b></div>
                    </a>
                </div>
            </div>  
        </x-has-access>
        <x-has-access name="reports.expired_material">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.expired_material') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Expired Material </b></div>
                    </a>
                </div>
            </div> 
        </x-has-access>
        <x-has-access name="reports.security">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports.security') }}" class="card-body btn">
                        <i class="text-warning bi bi-folder fa-2x mb-2"></i>
                        <div class="text-primary"><b> Security History</b></div>
                    </a>
                </div>
            </div>  
        </x-has-access>
    </div> 
@endsection 