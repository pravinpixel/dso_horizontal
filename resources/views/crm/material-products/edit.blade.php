@extends('layouts.app')
@section('content')
    <div class="card border" style="overflow: hidden">
         <div class="card-header border-bottom p-0">
            <ul class="nav nav-pills bg-nav-pills nav-justified m-0">
                <li class="nav-item">
                    <a href="{{ route('material-product.edit-form-one', $material_product->id) }}" class="nav-link py-2 rounded-0 {{ Route::is('material-product.edit-form-one') ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('material-product.edit-form-two', $material_product->id) }}" class="nav-link py-2 rounded-0 {{ Route::is('material-product.edit-form-two') ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('material-product.edit-form-three', $material_product->id)  }}" class="nav-link py-2 rounded-0 {{ Route::is('material-product.edit-form-three') ? "active" : '' }}">
                        <span class="h5">Non-Mandatory fields</span>
                    </a>
                </li>
            </ul>
        </div> 
        @yield('wizzard-form-content') 
    </div>
@endsection

 