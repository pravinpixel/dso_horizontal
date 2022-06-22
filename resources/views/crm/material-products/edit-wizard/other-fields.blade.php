@extends('crm.material-products.edit')
@section('wizzard-form-content')
    {!! Form::model($material_product, ['route' => ['edit_or_duplicate.material-product', "wizard_mode"=>'edit',"type" => 'form-four' , "id" => $material_product->id , "batch_id" => $batch_id ], 'id' => 'edit_other_form', 'class' => 'row wizzard-form', 'method'=> 'post','files'=>true]) !!}
        <div class="card-body row">
            @include('crm.material-products.fields.other-fields')
        </div>
        <div class="card-footer border-top bg-light"> 
            <a href="{{ route('edit_or_duplicate.material-product', ["wizard_mode"=>'edit',"type" => 'form-three' , "id" => $material_product->id , "batch_id" => $batch_id]) }}" class="btn btn-light rounded-pill shadow-sm border">
                <b><i class="bi bi-arrow-left-circle me-1"></i> Prev</b>
            </a>
            <button class="btn btn-primary  bg-primary-2  float-end rounded-pill"  onclick="submitAndSave(event)">
                <b><i class="bi bi-check-circle mse-1"></i> Submit & Save</b>
            </button>
        </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
<script> 

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
                    swal("print");
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