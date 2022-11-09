<script src="{{ asset('public/asset/js/vendors/jquery.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/jquery.validate.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/popper.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/moment.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/axios.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/Chart.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/dataTables.min.js') }}"></script>
<script src="{{ asset('public/asset/js/vendors/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('public/asset/js/app.js') }}"></script>
@yield('scripts')
{{-- <script> 
    $(document).ajaxStart(function(){
        console.log("Start") 
    });
    $(document).ajaxComplete(function(){
        console.log("End....")
    });
</script> --}}
@if ($message = Session::get('success_message')) <script>swal({text: "{{ $message }}",icon: "success",})</script> @endif