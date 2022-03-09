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

$(function(){"use strict";$("#basicwizard").bootstrapWizard(),$("#progressbarwizard").bootstrapWizard({onTabShow:function(t,r,a){var o=(a+1)/r.find("li").length*100;$("#progressbarwizard").find(".bar").css({width:o+"%"})}}),$("#btnwizard").bootstrapWizard({nextSelector:".button-next",previousSelector:".button-previous",firstSelector:".button-first",lastSelector:".button-last"}),$("#rootwizard").bootstrapWizard({onNext:function(t,r,a){var o=$($(t).data("targetForm"));if(o&&(o.addClass("was-validated"),!1===o[0].checkValidity()))return event.preventDefault(),event.stopPropagation(),!1}})});