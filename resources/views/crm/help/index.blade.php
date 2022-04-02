@extends('layouts.app')
@section('content')
    <section class="bg-white p-4 border shadow-sm mb-5">
        <div class="row align-items-center">
            <div class="col-4">
                <img class="w-100" src="{{ asset("public/asset/images/help.webp") }}">
            </div>
            <div class="col-8">
                <div class="list-group mb-3"  >
                    @foreach ($data as $row)
                        <div  class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $row->title }}</h5>
                            </div>
                            <p class="mb-1">{{ $row->description }}</p>
                            @if (!empty($row->attachments)) 
                                <a class="text-primary" href="{{ route('help.document', $row->id) }}"><i class="bi bi-download me-1"></i>Download attachment</a>
                            @endif 
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {!! $data->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection