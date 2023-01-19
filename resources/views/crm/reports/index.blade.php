@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs mt-3">
        <x-has-access name="reports.utilization-cart">
            <li class="nav-item">
                <a href="{{ route('reports.utilization-cart') }}" class="bg-none nav-link {{ Route::is(['reports.utilization-cart']) ? "active" : "" }}">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Utilization Cart</span>
                </a>
            </li>
        </x-has-access>
        <x-has-access name="reports.material_in_house_pdt_history">
            <li class="nav-item">
                <a href="{{ route('reports.material_in_house_pdt_history') }}" class="bg-none nav-link {{ Route::is(['reports.material_in_house_pdt_history','reports']) ? "active" : "" }}">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Products History </span>
                </a>
            </li>
        </x-has-access>
        <x-has-access name="reports.deduct_track_usage">
            <li class="nav-item">
                <a href="{{ route('reports.deduct_track_usage') }}" class="bg-none nav-link {{ Route::is(['reports.deduct_track_usage']) ? "active" : "" }}">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Deduct Track Usage</span>
                </a>
            </li>
        </x-has-access>
        <x-has-access name="reports.deduct_track_outlife">
            <li class="nav-item">
                <a href="{{ route('reports.deduct_track_outlife') }}" class="bg-none nav-link {{ Route::is(['reports.deduct_track_outlife']) ? "active" : "" }}">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Deduct Track Outlife</span>
                </a>
            </li>
        </x-has-access>
        <x-has-access name="reports.disposed_items">
            <li class="nav-item">
                <a href="{{ route('reports.disposed_items') }}" class="bg-none nav-link {{ Route::is(['reports.disposed_items']) ? "active" : "" }}">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Disposed items</span>
                </a>
            </li>
        </x-has-access>
        <x-has-access name="reports.expired_material">
            <li class="nav-item">
                <a href="{{ route('reports.expired_material') }}" class="bg-none nav-link {{ Route::is(['reports.expired_material']) ? "active" : "" }}">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Expired Material Report</span>
                </a>
            </li>
        </x-has-access>
        <x-has-access name="reports.security">
            <li class="nav-item">
                <a href="{{ route('reports.security') }}" class="bg-none nav-link {{ Route::is(['reports.security']) ? "active" : "" }}">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Security History</span>
                </a>
            </li>
        </x-has-access>
    </ul>
    <section class="pt-3">
        @yield('report_content')
    </section>
@endsection
@section('styles')
    <style>#breadcrumb {display: none !important}</style>
@endsection
