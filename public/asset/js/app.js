function printModal() {
    swal({
        text: "Do you want to print?",
        icon: "info",
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn-light rounded-pill btn",
                closeModal: true,
            },
            confirm: {
                text: "Proceed to print",
                value: true,
                visible: true,
                className: "btn-primary rounded-pill btn",
                closeModal: true
            }
        }, 
    });
}
function deleteModal() {
    swal({
        text: "Are you sure want to Delete?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn-light rounded-pill btn",
                closeModal: true,
            },
            confirm: {
                text: "Yes! Delete",
                value: true,
                visible: true,
                className: "btn btn-danger rounded-pill",
                closeModal: true
            }
        }, 
    });
}
 
function Message(type, res) {
    $('body').append(`
        <div id="alert" class="alert alert-primary alert-dismissible bg-${type} text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>${res}</strong>
        </div>
    `);
    setTimeout(() => {
        $(".alert").fadeOut();
    }, 2000);
}
setTimeout(() => {
    $(".alert").fadeOut();
}, 2000);


$(document).on('click' ,'#confirmDelete',function (event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        text: "Are you sure want to Delete?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn-light rounded-pill btn",
                closeModal: true,
            },
            confirm: {
                text: "Yes! Delete",
                value: true,
                visible: true,
                className: "btn btn-danger rounded-pill",
                closeModal: true
            }
        },
    }).then((isConfirm) => {
        if (isConfirm) {
            form.submit();
        }
    });
});

$('#loader').append('<i id="preLoader" class="bi bi-arrow-repeat text-white rotate"></i>');
$(window).on('load', function(){
    setTimeout(removeLoader, 500); //wait for page load PLUS two seconds.
});

function removeLoader(){
    $( "#preLoader" ).fadeOut(500, function() {
        // fadeOut complete. Remove the loading div
        $( "#preLoader" ).remove(); //makes page more lightweight 
    });  
}