@extends('layouts.app')
@section('content')
    <section class="bg-white border shadow-sm mb-5">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $data->title }}</h5>
                </div>
                <p class="mb-1">{{ $data->description }}</p>
                
                <div class="shadow my-3">
                    <iframe width="100%" height="800px" src="{{ url("storage/app")."/".$data->attachments }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection