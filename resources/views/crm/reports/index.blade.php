@extends('layouts.app')
@section('content') 
    <ul class="nav nav-tabs">
        {{-- <li class="nav-item">
            <a href="{{ route('reports.utilisation_cart') }}" class="bg-none nav-link {{ Route::is(['reports','reports.utilisation_cart']) ? "active" : "" }}">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate Material/ In-house Product Utilisation rate </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.export_cart') }}" class="bg-none nav-link {{ Route::is(['reports.export_cart']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate list of Material/In-house Product</span>
            </a>
        </li>  --}}
        <li class="nav-item">
            <a href="{{ route('reports.deduct_track_outlife') }}" class="bg-none nav-link {{ Route::is(['reports.deduct_track_outlife']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Deduct Track Outlife</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.disposed_items') }}" class="bg-none nav-link {{ Route::is(['reports.disposed_items','reports']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Disposed items</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.expired_material') }}" class="bg-none nav-link {{ Route::is(['reports.expired_material']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Expired Material Report</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="{{ route('reports.security') }}" class="bg-none nav-link {{ Route::is(['reports.security']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Security History</span>
            </a>
        </li> 
    </ul> 
    <section class="pt-3">
        @yield('report_content')
    </section> 
@endsection  