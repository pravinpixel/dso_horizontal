@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    DEFAULT BUTTONS
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary">Primary</button>
                    <button type="button" class="btn btn-secondary">Secondary</button>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-danger">Danger</button>
                    <button type="button" class="btn btn-warning">Warning</button>
                    <button type="button" class="btn btn-info">Info</button>
                    <button type="button" class="btn btn-light">Light</button>
                    <button type="button" class="btn btn-dark">Dark</button>
                    <button type="button" class="btn btn-link">Link</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    BUTTON-ROUNDED
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary rounded-pill">Primary</button>
                    <button type="button" class="btn btn-secondary rounded-pill">Secondary</button>
                    <button type="button" class="btn btn-success rounded-pill">Success</button>
                    <button type="button" class="btn btn-danger rounded-pill">Danger</button>
                    <button type="button" class="btn btn-warning rounded-pill">Warning</button>
                    <button type="button" class="btn btn-info rounded-pill">Info</button>
                    <button type="button" class="btn btn-light rounded-pill">Light</button>
                    <button type="button" class="btn btn-dark rounded-pill">Dark</button>
                    <button type="button" class="btn btn-link rounded-pill">Link</button>  
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    BUTTON OUTLINE
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-outline-primary">Primary</button>
                    <button type="button" class="btn btn-outline-secondary">Secondary</button>
                    <button type="button" class="btn btn-outline-success"><i class="uil-cloud-computing"></i> Success</button>
                    <button type="button" class="btn btn-outline-danger">Danger</button>
                    <button type="button" class="btn btn-outline-warning">Warning</button>
                    <button type="button" class="btn btn-outline-info"><i class="uil-circuit"></i> Info</button>
                    <button type="button" class="btn btn-outline-light">Light</button>
                    <button type="button" class="btn btn-outline-dark">Dark</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    BUTTON OUTLINE ROUNDED
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-outline-primary rounded-pill">Primary</button>
                    <button type="button" class="btn btn-outline-secondary rounded-pill">Secondary</button>
                    <button type="button" class="btn btn-outline-success rounded-pill"><i class="uil-cloud-computing"></i> Success</button>
                    <button type="button" class="btn btn-outline-danger rounded-pill">Danger</button>
                    <button type="button" class="btn btn-outline-warning rounded-pill">Warning</button>
                    <button type="button" class="btn btn-outline-info rounded-pill"><i class="uil-circuit"></i> Info</button>
                    <button type="button" class="btn btn-outline-light rounded-pill">Light</button>
                    <button type="button" class="btn btn-outline-dark rounded-pill">Dark</button>
                </div>
            </div>   
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Colores
                </div>
                <div class="card-body">
                    <div class="p-3 py-2 m-1 bg-primary-2"></div>
                    <div class="p-3 py-2 m-1 bg-primary"></div>
                    <div class="p-3 py-2 m-1" style="background: #FDCA3F"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    BUTTON-SIZES
                </div>
                <div class="card-body">
                    <button type="button" class="mb-3 btn btn-primary btn-lg">Large</button> <br>
                    <button type="button" class="mb-3 btn btn-info">Normal</button> <br>
                    <button type="button" class="btn btn-success btn-sm">Small</button>
                </div>
            </div>
        </div>    
    </div>   
         
@endsection 