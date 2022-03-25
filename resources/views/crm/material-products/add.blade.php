@extends('layouts.app')
@section('content')
    <div class="card border" style="overflow: hidden">
        <div class="card-header border-bottom p-0">
            <ul class="nav nav-pills bg-nav-pills nav-justified m-0">
                <li class="nav-item">
                    <a href="{{ route('mandatory-form-one') }}" class="nav-link py-2 rounded-0 {{ Route::is('mandatory-form-one') ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mandatory-form-two') }}" class="nav-link py-2 rounded-0 {{ Route::is('mandatory-form-two') ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('non-mandatory-form') }}" class="nav-link py-2 rounded-0 {{ Route::is('non-mandatory-form') ? "active" : '' }}">
                        <span class="h5">Non-Mandatory fields</span>
                    </a>
                </li>
            </ul>
        </div>
        @yield('wizzard-form-content')
        {{-- <div class="card-footer border-top bg-light"> 

            @if (!Route::is('mandatory-form-one'))
                <a  href="
                            @if (Route::is('mandatory-form-two'))
                                {{ route('mandatory-form-one') }}
                            @endif
                            @if (Route::is('non-mandatory-form'))
                                {{ route('mandatory-form-two') }}
                            @endif
                        " 
                    class="btn btn-light rounded-pill shadow-sm border">
                    <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
                </a>
            @endif 

            @if (Route::is(['mandatory-form-one','mandatory-form-two']))
                <a  href="
                            @if (Route::is('mandatory-form-one'))
                                {{ route('mandatory-form-two') }}
                            @endif
                            @if (Route::is('mandatory-form-two'))
                                {{ route('non-mandatory-form') }}
                            @endif
                        " 
                    class="btn btn-primary float-end rounded-pill" type="submit">
                    <b>Next <i class="bi bi-arrow-right-circle ms-1"></i></b>
                </a> 
            @endif

            @if (!Route::is(['mandatory-form-one','mandatory-form-two']))
                <a  href="#" class="btn bg-primary-2 btn-primary float-end rounded-pill" onclick="event.preventDefault();document.getElementById('wizzard-form').submit();">
                    <b><i class="bi bi-check-circle mse-1"></i> Submit & Save</b>
                </a>
            @endif 
            
        </div> --}}
    </div>
@endsection