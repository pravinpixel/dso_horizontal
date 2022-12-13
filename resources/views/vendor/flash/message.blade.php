@if ($message = Session::get('success'))
    <div class="alert alert-primary alert-dismissible bg-success text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
        <strong><i class="fa fa-check-circle fa-2x me-2"></i></strong>
        <strong>
            {{ $message }}
        </strong>
        <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
    </div>
@endif

@if ($message = Session::get('error'))

    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
        <strong><i class="fa fa-times-circle fa-2x me-2"></i></strong>
        <strong>
            {{ $message }}
        </strong>
        <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
    </div>

@endif



@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible bg-warning text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
        <strong><i class="fa fa-times-circle fa-2x me-2"></i></strong>
        <strong>
            {{ $message }}
        </strong>
        <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-primary alert-dismissible bg-info text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
        <strong><i class="fa fa-info-circle fa-2x me-2"></i></strong>
        <strong>
            {{ $message }}
        </strong>
        <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
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
            <strong><i class="fa fa-{{ $message['level'] == 'danger' ? "times" : 'check'}}-circle fa-2x me-2"></i></strong>
            <strong>{!! $message['message'] !!}</strong>
            <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
