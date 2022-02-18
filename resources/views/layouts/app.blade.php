<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://www.dso.org.sg/media/default/theme/favicon.png" rel="shortcut icon" type="image/png" />
    <title>DSO</title>

    {{--  ===== STYLES ======= --}}
        @include('includes.styles')
    {{--  ===== STYLES ======= --}}

</head>
<body>

    <div class="sticky-top">
        @include('includes.sections.nav-bar')
        @include('includes.sections.top-nav-bar')
    </div> 

    @include('includes.sections.breadcrumb')

    <main class="container-fluid" style="min-height: 80vh">
        @yield('content')
    </main>
    <footer class="bg-primary-2">
        <div class="container-fluid">
            <div class="row m-0 ">
                <div class="p-1 col text-start">
                    <small class="text-warning">People . Passion. Innovation.</small>
                </div>
                <div class="p-1 col text-end">
                    <small class="text-warning">DSO- EG1 Inventory Management System.</small>
                </div>
            </div>
        </div>
    </footer>
    {{-- ========= SCRIPTS  ==========--}}
        @include('includes.scripts')
    {{-- ========= SCRIPTS  ==========--}}
</body>
</html>