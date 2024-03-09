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
@if ($message = Session::get('success_message'))
    <script>
        swal({
            text: "{{ $message }}",
            icon: "success",
        })
    </script>
@endif
<script>
    const isNumber = (element) => {
        if (Number(element.target.max) < Number(element.target.value)) {
            element.target.value = element.target.max
            return false
        }
    }
    const AppUrl = "{{ url('/') }}"
    deleteFile = (batch_id, element) => {
        fetch(`${AppUrl}/delete-file/${batch_id}`).then((res) => res.json()).then((data) => {
            element.parentNode.classList.add('d-none')
           if(data.type=="iqc_result"){
            if(data.iqc_result !=0){
            var count=data.iqc_result-1;
            if(count==0){
            $('input#iqc_status_input').prop('required', true);
            }
        }else{
             $('input#iqc_status_input').prop('required', true);
        }

           }
           if(data.type=="coc_coa_mill_cert"){
            if(data.iqc_result !=0){
             var count=data.iqc_result-1;
             if(count==0){
             $('input#coc_coa_mill_cert_input').prop('required', true);
            }
        }else{
            $('input#coc_coa_mill_cert_input').prop('required', true);
           }
        }
        })
    }
    removeNotification = (id,element) => {
        fetch(`${AppUrl}/delete-notification/${id}`).then((res) => res.json()).then((data) => {
            element.parentNode.parentNode.parentNode.classList.add('d-none')
        })
    }
</script>
