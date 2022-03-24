{{-- ICONS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

{{-- APP STYLES --}}
<link rel="stylesheet" href="{{ asset('public/asset/css/app.css') }}"> 
<link rel="stylesheet" href="{{ asset('public/asset/css/custom.css') }}">


{{-- Animated --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

{{-- Fonts  --}}
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">


{{-- Datatables --}}
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">


 
<script>
    function Message(type, res) {
        $('body').append(`
            <div id="alert" class="alert alert-primary alert-dismissible bg-${type} text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>${res}</strong>
            </div>
        `);
        setTimeout(() => {
            $(".alert").fadeOut();
        }, 2000);
    }
</script>
