@extends('layouts.app')
@section('content') 
    <div ng-app="RootApp" ng-controller="RootController">
        {{-- = ==== Filletrs ====--}}
            @include('crm.partials.table-filter')
        {{-- ====== Filletrs ===--}}
         
        <section>
            @include('crm.partials.data-table')
        </section>

        {{-- ======= START : App Models ==== --}}
            @include('crm.material-products.modals.view-batch-list')
            @include('crm.material-products.modals.view-list')
            @include('crm.material-products.modals.advance-search')
            @include('crm.material-products.modals.saved-search')
            @include('crm.material-products.modals.transfer')
            @include('crm.material-products.modals.repack-transfers')
            @include('crm.material-products.modals.repack-outlife')
            @include('crm.material-products.modals.import-from-excel')
            @include('crm.material-products.modals.reconciliation')
        {{-- ======= END : App Models ==== --}}
    </div>  
@endsection
@include('includes.dso-datatable')