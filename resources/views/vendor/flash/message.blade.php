@if ($message = Session::get('success'))
 
    <div class="alert alert-primary alert-dismissible bg-success text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Success !</strong>   {{ $message }}
    </div>

@endif


@if ($message = Session::get('error'))

    <div class="alert alert-danger alert-block">

        <button type="button" class="close" data-dismiss="alert">×</button>	

            <strong>{{ $message }}</strong>

    </div>

@endif



@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
@endif

 
@if ($errors->any())
    <div id="alert" class="alert alert-primary alert-dismissible bg-danger text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @foreach ($errors->all() as $error)
            <div><strong>{{ $error }}</strong></div>
        @endforeach
    </div>
@endif

@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else 
        <div class="alert alert-{{ $message['level'] }} alert-dismissible bg-{{ $message['level'] == 'danger' ? "danger" : 'success'}} text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{!! $message['message'] !!}</strong>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
