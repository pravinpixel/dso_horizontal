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
    <a onclick="clearEntryData()"><i class="bi bi-x-circle"></i> <u>Cancel & Back</u> </a>
    {{-- <div id="clearEntry" onclick="clearEntryData()"></div> --}}
    <script>
        function clearEntryData ()  {
            swal({
                title:'Cancel Entry ?',
                text: "Changes you made may not be saved.",
                icon: "info",
                closeOnClickOutside: false,
                buttons: {
                    cancel: {
                        text: "Cancel",
                        visible: true,
                        className: "btn btn-light rounded-pill",
                        closeModal: true,
                        value: "No cancel it",
                    },
                    save: {
                        text: "Yes !, Leave",
                        value: "save",
                        visible: true,
                        className: "btn btn-success rounded-pill",
                        closeModal: true,
                    },
                },
            }).then((value) => { 
                switch (value) {
                    case "cancel":
                        swal("cancel");
                            break; 
                            case "save":
                            $.ajax({
                                type    :   'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url     :   "{{ route('delete-material-products-batch', request()->route()->batch_id) }}",
                                success:function(response){
                                    window.location.replace('{{ route("list-material-products") }}');
                                }
                            });
                    break; 
                }
            });
        }
    </script>
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
    function submitAndSave(e) {
        e.preventDefault();
        $('#hidden_input').html(`<input type="hidden" name="is_draft" value="0">`);
        swal({
            text: "Do You Want To Print?",
            icon: "info",
            closeOnClickOutside: false,
            buttons: {
                print: {
                    text: "Yes !, Proceed to Print",
                    visible: true,
                    className: "btn btn-primary rounded-pill",
                    closeModal: true,
                    value: "print",
                },
                save: {
                    text: "No !, Submit & Save",
                    value: "save",
                    visible: true,
                    className: "btn btn-success rounded-pill",
                    closeModal: true,
                },
            },
        })
        .then((value) => { 
            switch (value) {
                case "print":
                    $('#hidden_input').append(`<input type="hidden" name="is_print" value="1">`);
                    $("#duplicate_other_form").submit();
                break;
                case "cancel":
                    swal("cancel");
                    $('#hidden_input').html("");
                break; 
                case "save":
                    $("#duplicate_other_form").submit();
                break; 
            }
        });
    }
     
</script>

@endsection