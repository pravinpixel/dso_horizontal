var   APP_URL = $('meta[name="app-url"]').attr('content') ;
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
                text: "No",
                value: null,
                visible: true,
                className: "btn-light rounded-pill btn",
                closeModal: true,
            },
            confirm: {
                text: "Yes",
                value: true,
                visible: true,
                className: "btn btn-danger rounded-pill",
                closeModal: true
            }
        },
    });
}
function Message(type, message) {
    if(message === undefined) {
        type    = "danger"
        message = "Permission Denied ! Contact your admin"
    }
    $('body').append(`
        <div class="alert alert-primary alert-dismissible bg-${type} text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
            <strong><i class="fa fa-check-circle fa-2x me-2"></i></strong>
            <strong>${message}</strong>
            <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
        </div>
    `);
    setTimeout(() => {
        $(".alert").fadeOut();
    }, 3000);
    document.querySelectorAll(".btn-loader").forEach(button => {
        button.classList.remove("start-loader")
    });
}
setTimeout(() => {
    $(".alert").fadeOut();
}, 3000);


$(document).on('click' ,'#confirmDelete',function (event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        text: "Are you sure want to Delete?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "No",
                value: null,
                visible: true,
                className: "btn-light rounded-pill btn",
                closeModal: true,
            },
            confirm: {
                text: "Yes",
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
$('.two-digits').keyup(function(){
    if($(this).val().indexOf('.')!=-1){
        if($(this).val().split(".")[1].length > 2){
            if( isNaN( parseFloat( this.value ) ) ) return;
            this.value = parseFloat(this.value).toFixed(2);
        }
    }
    return this; //for chaining
});
$('.three-digits').keyup(function(){
    if($(this).val().indexOf('.')!=-1){
        if($(this).val().split(".")[1].length > 3){
            if( isNaN( parseFloat( this.value ) ) ) return;
            this.value = parseFloat(this.value).toFixed(3);
        }
    }
    return this; //for chaining
});
$(":input").attr("autocomplete","off");


saved_this_search = (e) => {
    if(e.checked ===  true) {
        $('#save-search-name').modal('show')
    } else {
        $('#save-search-name').modal('hide')
    }
}
uncheckedSavedSearch = (e) => {
    $('#saveThisSearch').prop('checked', false);
}


$('.need-word-match').keyup((element) => {
    if(element.target.hasAttribute("list") == false) {
        var listAtt     =   document.createAttribute("list");
        listAtt.value   =   `td_${element.target.name}`;
        element.target.setAttributeNode(listAtt)

        var dataList    =   document.createElement("datalist");
        dataList.id     =   `td_${element.target.name}`;
        element.target.parentNode.append(dataList)
    }


    fetch(APP_URL + '/get-suggestion', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({
            "name"  : element.target.name,
            "value" : element.target.value,
        })
    }).then(response => response.json()).then(response => {
        $(`#td_${element.target.name}`).html('')
        if(response.data != undefined || response.data != null) {
            Object.values(response.data).map((item) => {
                if(element.target.value !== item) {
                    $(`#td_${element.target.name}`).append(`<option value="${item}">`)
                }
            })
        }
    });
})


validateDate = (endInput, element) => {
    var dateInput = document.querySelector(`input[name=${endInput}]`)
    dateInput.setAttribute('min',element.value)
}
getNotificationCount = () => {
    fetch(APP_URL + '/NotificationCount').then(response => response.json()).then(response => {
        var NotificationData    = response.data;
        var NotificationCount   = document.getElementById('NotificationCount')
        var NotificationList    = document.getElementById('NotificationList')

        NotificationList.innerHTML  = ''
        NotificationCount.innerHTML = response.count

        NotificationData.map((item) => {
            return NotificationList.innerHTML += `
                <li class="list-group-item list-group-item-action btn">
                    <a href="${APP_URL}/notification/threshold-qty" class="text-dark">
                        <div><b class="text-primary"><i class="bi bi-bell-fill ${ item.batches.length != 0 ?  item.quantityColor : "" } "></i> ${item.item_description.toUpperCase()}</b></div>
                        <small><b class="text-dark">Unit packing value :</b> ${ item.batches.length != 0 ?  item.unit_packing_value  : "" } </small>  <br>
                        <small><b class="text-dark">Quantity :</b> ${ item.batches.length != 0 ?  item.material_quantity : "" }</small>
                        <small class="float-end ${ item.batches.length != 0 ?  item.quantityColor : "" } "><i class="bi bi-calendar2-week"></i> ${ moment(item.updated_at).format('DD/MM/YYYY h:m A')}</small>
                    </a>
                </li>
            `
        });
    });
}
getNotificationCount()

formConfirm = (event) => {
    event.preventDefault();
    swal({
        text: event.target.attributes['alert-text'].value,
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
                text: "Yes",
                value: true,
                visible: true,
                className: "btn btn-primary rounded-pill",
                closeModal: true
            }
        },
    }).then((isConfirm) => {
        if(isConfirm) {
            event.target.submit()
        }
    });
}
checkboxConfirm = (event) => {
    event.preventDefault();
    swal({
        text: event.target.attributes['alert-text'].value,
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
                text: "Yes",
                value: true,
                visible: true,
                className: "btn btn-primary rounded-pill",
                closeModal: true
            }
        },
    }).then((isConfirm) => {
        if(isConfirm) {
            event.target.checked =  true
            return true
        }
    });
}

addToCart = (element,type) => {
    var PayLoad = {
        batch_id    : element.getAttribute('batch-id'),
        material_id : element.getAttribute('material-id'),
    }
    axios.post(`${APP_URL}/product-cart`, PayLoad ).then((response) => {
        Message('success', response.data.message)
        getToCart(type)
    }).catch((error) => {
        console.log(error.message)
    })
}
deleteToCart = (id) => {
    axios.delete(`${APP_URL}/product-cart/${id}`).then((response) => {
        Message('success', response.data.message)
        getToCart(response.data.type)
    }).catch((error) => {
        console.log(error.message)
    })
}
getToCart = (type) => {
    var row = '';
    axios.get(`${APP_URL}/product-cart`).then((response) => {
        if(response.data) {
            response.data.map((item) => {
                row += `
                    <tr>
                        <td>${item.batches.batch_material_product.item_description}</td>
                        <td>${item.batches.brand}</td>
                        <td>${item.batches.batch} | ${item.batches.serial}</td>
                        <td>${item.batches.unit_packing_value}</td>
                        <td>${item.batches.quantity}</td>
                        <td>
                            <i onclick="deleteToCart(${item.id})" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
                    </tr>
                `;
            })
        }
        var table = document.querySelector(`cart-table[type=${type}]`);
        if(table != null) {
            try {
                table.innerHTML = `
                    <div class="card shadow-sm border">
                        <div class="card-header bg-success">
                            <h5 class="card-title text-center text-white m-0">Material/ In-house Product Cart List</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm bg-white table-bordered table-hover custom-center m-0">
                                <thead class="bg-light ">
                                    <tr>
                                        <th class="text-dark">Item description</th>
                                        <th class="text-dark">Brand</th>
                                        <th class="text-dark">Batch#/ Serial#</th>
                                        <th class="text-dark">Pkt size</th>
                                        <th class="text-dark">Withdraw Qty</th>
                                        <th class="text-dark">
                                            <i class="text-danger bi bi-trash3-fill"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>${row}</tbody>
                            </table>
                        </div>
                        <div class="card-footer text-end bg-light">
                            <button type="submit" class="btn btn-success rounded-pill"><i class="bi bi-arrow-repeat"></i> Generate</button>
                        </div>
                    </div>
                `;
            } catch (error) {
                console.log(error)
            }
        }
    });
}
try {
    getToCart('DEDUCT_TRACK_USAGE_REPORT')
} catch (error) {
    console.log(error)
}

document.querySelectorAll(".btn-loader").forEach(button => {
    button.addEventListener('click', (e) => {
        e.target.classList.add("start-loader")
    })
});

viewBatch = (id) => {
    axios.get(`${APP_URL}/get-material-batch/${id}`).then(function (response) {
        $('#View_Batch_Details').modal('show');
        document.getElementById('View_Batch_Details_Data').innerHTML = response.data
    }).catch(function (error) {
        console.log(error);
    });
}

viewParentBatch = (id) => {
    axios.get(`${APP_URL}/get-material/${id}`).then(function (response) {
        $('#View_Material_Product_Details').modal('show');
        document.getElementById('View_Material_Product_Details_Data').innerHTML = response.data
    }).catch(function (error) {
        console.log(error);
    });
}

deleteBatchFile = (id,type,element) => {
    axios.get(`${APP_URL}/delete-batch-file/${id}/${type}`).then(function (response) {
        element.parentNode.classList.add('d-none')
    }).catch(function (error) {
        console.log(error);
    });
}


download = (id,type) => {
    const FORM = `
        <form id="downloadForm" action="${APP_URL}/download-files/${id}/${type}" method="POST">
            <input type="hidden" value="${$('meta[name="csrf-token"]').attr('content')}" name="_token" />
        </form>
    `
    $('body').append(FORM);
    setTimeout(() => {
        $(`#downloadForm`).submit()
    }, 500);
    setTimeout(() => {
        $(`#downloadForm`).remove()
    }, 2000);
}
