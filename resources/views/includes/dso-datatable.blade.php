@section('styles')
    <link rel="stylesheet" href="{{ asset('public/asset/css/vendors/date-picker.css') }}" />
@endsection
@section('scripts')
    <input type="hidden" id="get-material-products" value="{{ route('get-material-products') }}">
    <input type="hidden" id="delete-material-products" value="{{ route('delete-material-products') }}">
    <input type="hidden" id="delete-material-products-batch" value="{{ route('delete-material-products-batch') }}">
    <input type="hidden" id="get-save-search" value="{{ route('get-save-search') }}">
    <input type="hidden" id="get-batch-material-products" value="{{ route("get-batch-material-products") }}">
    <input type="hidden" id="get-batch" value="{{ route("get-batch") }}">
    <input type="hidden" id="get_masters" value="{{ route("get_masters") }}">
    <input type="hidden" id="transfer_batch" value="{{ route("transfer-batch") }}"> 
    <input type="hidden" id="repack_batch" value="{{ route("repack-batch") }}"> 
    <input type="hidden" id="auth-id" value="{{ Sentinel::getUser()->id }}">
    <input type="hidden" id="change_batch_read_status" value="{{ route('change-read-status') }}"/>
    <input type="hidden" id="auth-role" value="{{ Sentinel::getUser()->roles[0]->slug }}"> 
    <script src="{{ asset('public/asset/js/vendors/daterangepicker.js') }}"></script>
    <script src="{{ asset('public/asset/js/vendors/angular.min.js') }}"></script>
    <script src="{{ asset('public/asset/js/vendors/angular-sanitize.js') }}"></script>
    <script src="{{ asset('public/asset/js/vendors/angular-messages.js') }}"></script>
    <script src="{{ asset('public/asset/js/vendors/date-picker.js') }}"></script>
    <script src="{{ asset('public/asset/js/modules/RootApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/RootController.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/pagePagination.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/RepackOutlife.js') }}"></script>  
    <script src="{{ asset('public/asset/js/directives/RepackAndTransfer.js') }}"></script>
    <script>
        wordMatchSuggest = (element) => {
            $.ajax({
                type    :   'GET',
                url     :   "{{ route('suggestion') }}",
                data    :  {
                    "name"  : element.name,
                    "value" : element.value,
                } ,
                success:function(response){
                    $(`#${element.list.id}`).html('')
                    if(response.data != undefined || response.data != null) {
                        Object.values(response.data).map((item) => { 
                            if(element.value !== item) {
                                $(`#${element.list.id}`).append(`<option value="${item}">`)
                            }
                        })
                    }
                }
            });
        }
    </script>
@endsection