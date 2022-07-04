@extends('layouts.app')
@section('content')
    <div class="card border" style="overflow: hidden">
         <div class="card-header border-bottom p-0">
            <ul class="nav nav-pills bg-nav-pills nav-justified m-0">
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'duplicate',"type" => 'form-one' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-one' ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'duplicate',"type" => 'form-two' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-two' ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'duplicate',"type" => 'form-three' , "id" => $material_product->id , "batch_id" => $batch_id])  }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-three' ? "active" : '' }}">
                        <span class="h5">Non-Mandatory fields</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'duplicate',"type" => 'form-four' , "id" => $material_product->id , "batch_id" => $batch_id])  }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-four' ? "active" : '' }}">
                        <span class="h5">Other fields</span>
                    </a>
                </li>
            </ul>
        </div> 
        @yield('wizzard-form-content') 
    </div>
    <a href="{{ route('list-material-products') }}"><i class="bi bi-x-circle"></i> <u>Cancel & Back</u> </a> 
@endsection
@section('scripts')
<script>
    function outlifeChange() {
        var input = $('#require_outlife_tracking_status_input').val();
        if(input != 1) {
            $("#outlife_input").prop('disabled', true);
            $("#outlife_input").val(null)
        } else {
            $("#outlife_input").prop('disabled', false);
        }
    }
    outlifeChange()
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