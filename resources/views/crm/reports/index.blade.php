@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs mt-3">
        <li class="nav-item">
            <a href="{{ route('reports.utilization-cart') }}" class="bg-none nav-link {{ Route::is(['reports.utilization-cart']) ? "active" : "" }}">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Utilization Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.material_in_house_pdt_history') }}" class="bg-none nav-link {{ Route::is(['reports.material_in_house_pdt_history','reports']) ? "active" : "" }}">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Material inHouse pdt History </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.deduct_track_usage') }}" class="bg-none nav-link {{ Route::is(['reports.deduct_track_usage']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Deduct Track Usage</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.deduct_track_outlife') }}" class="bg-none nav-link {{ Route::is(['reports.deduct_track_outlife']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Deduct Track Outlife</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.disposed_items') }}" class="bg-none nav-link {{ Route::is(['reports.disposed_items']) ? "active" : "" }}">
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
@section('styles')
    <style>#breadcrumb {display: none !important}</style>
@endsection
