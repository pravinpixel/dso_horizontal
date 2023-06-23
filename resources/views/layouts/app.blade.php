<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSO</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="app-url" content="{{ url('') }}" />

    {{--  ===== STYLES ======= --}}
        @include('includes.styles')
    {{--  ===== STYLES ======= --}}
    <input type="hidden" id="app_URL" value="{{ url('') }}">
</head>
<body>
    @include('flash::message')

    <div class="sticky-top" id="navigation_menu">
        @include('includes.sections.nav-bar')
        @include('includes.sections.top-nav-bar')
    </div>

    @include('includes.sections.breadcrumb')


    <main class="container-fluid" style="min-height: 80vh">
        @yield('content')
    </main>

    <div id="notification-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>Notifications</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll">
                    <div class="text-s">
                        <ul class="list-group" id="NotificationList"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========= SCRIPTS  ==========--}}
        @include('includes.scripts')
    {{-- ========= SCRIPTS  ==========--}}
    {{-- <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script> --}}
    {{-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> --}}
</body>
</html>
