var APP_URL = $('meta[name="app-url"]').attr('content') ;
const web = axios
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
                text: "Yes, Delete",
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
        <div class="alert alert-primary alert-dismissible bg-${type} text-white border-0 fade show animate__animated animate__jackInTheBox" role="alert">
            <strong><i class="fa fa-check-circle fa-2x me-2"></i></strong>   
            <strong>${res}</strong>
            <button class="btn btn-sm alert-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x text-white"></i></button>
        </div> 
    `);
    setTimeout(() => {
        $(".alert").fadeOut();
    }, 3000);
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
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn-light rounded-pill btn",
                closeModal: true,
            },
            confirm: {
                text: "Yes, Delete",
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
        var NotificationData            = response.data;
        var NotificationCount           = document.getElementById('NotificationCount')
        var NotificationList            = document.getElementById('NotificationList')
            NotificationCount.innerHTML = response.count

        NotificationData.map((item) => {
            NotificationList.innerHTML += `
                <li class="list-group-item list-group-item-action btn">
                    <div><a href="${APP_URL}/threshold-qty">${item.material_product.item_description}</a></div>
                    <small>${item.batch}</small>
                    <small class="float-end text-secondary">${ moment(item.created_at).format('YYYY-MM-DD h:m:s A')}</small>
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
        type        : type
    }
    web.post(`${APP_URL}/product-cart`, PayLoad ).then((response) => {
        Message('success', response.data.message)
        getToCart(type)
    }).catch((error) => {
        console.log(error.message)
    })
}
deleteToCart = (id,type) => { 
    web.delete(`${APP_URL}/product-cart/${id}`).then((response) => {
        Message('success', response.data.message)
        getToCart(type)
    }).catch((error) => {
        console.log(error.message)
    })
}
getToCart = (type) => { 
    var row = '';
    web.get(`${APP_URL}/get-product-cart/${type}`).then((response) => {
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
                            <i onclick="deleteToCart(${item.id},'${type}')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
                    </tr>
                `;
            }) 
        }
        document.querySelector(`cart-table[type=${type}]`).innerHTML = `
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-dark text-white" colspan="6">Utilisation Cart</th>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item description</th>
                        <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch#/ Serial#</th>
                        <th class="table-th child-td">Pkt size</th>
                        <th class="table-th child-td">Withdraw Qty</th>
                        <th class="table-th child-td">
                            <i class="text-danger bi bi-trash3-fill"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>${row}</tbody>
            </table>
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Generate</button>
            </div>
        `;
    }); 
}
getToCart('UTILISATION')