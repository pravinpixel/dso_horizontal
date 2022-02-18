<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSO</title>
    {{--  ===== STYLES ======= --}}
        @include('includes.styles')
    {{--  ===== STYLES ======= --}}
</head>
<body class="bg-white"> 
    @yield('content')
    {{-- ========= SCRIPTS  ==========--}}
        @include('includes.scripts')
    {{-- ========= SCRIPTS  ==========--}}
</body>
</html>