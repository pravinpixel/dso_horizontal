@extends('layouts.app')
@section('content')
    <div class="card border" style="overflow: hidden">
         <div class="card-header border-bottom p-0">
            <ul class="nav nav-pills bg-nav-pills nav-justified m-0">
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'edit',"type" => 'form-one' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-one' ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'edit',"type" => 'form-two' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-two' ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'edit',"type" => 'form-three' , "id" => $material_product->id , "batch_id" => $batch_id])  }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-three' ? "active" : '' }}">
                        <span class="h5">Non-Mandatory fields</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'edit',"type" => 'form-four' , "id" => $material_product->id , "batch_id" => $batch_id])  }}" class="nav-link py-2 rounded-0 {{ Request::route('type') == 'form-four' ? "active" : '' }}">
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
    function  change_product_type() {
        var CategoryType  = $('#category_type').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type:'POST',
            url:"{{ route('change-product-category') }}",
            data:{type: CategoryType },
            success:function(data){
                Message('success', data.message);
                location.reload();
            }
        });
    }
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
</script>
<script>
    function saveAsDraft(e) {
        e.preventDefault();  
        $('#hidden_input').html(`<input type="hidden" name="is_draft" value="1">`);
        swal({
            text: "Do You Want To Save Draft?",
            icon: "info",
            closeOnClickOutside: false,
            buttons: {
                cancel: {
                    text: "No!, Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes ! Save Draft",
                    value: true,
                    visible: true,
                    className: "btn btn-secondary rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $("#create_other_form").submit();
            }   else {
                $('#hidden_input').html("");
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
                    $("#edit_other_form").submit();
                break;
                case "cancel":
                    swal("cancel");
                    $('#hidden_input').html("");
                break; 
                case "save":
                    $("#edit_other_form").submit();
                break; 
            }
        });
    }
</script>
@endsection