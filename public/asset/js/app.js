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