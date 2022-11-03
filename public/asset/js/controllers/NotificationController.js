viewBatch = (id) => {
    axios.get(`${APP_URL}/view-batch/${id}`).then(function (response) {  
        var li = ''
        Object.entries(response.data).map((item) => {
            li += ` 
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">${item[0]}</div>
                            ${item[1]}
                    </div>
                </li>
            `
        })
        $("#Batch_Details").html(li)
        $('#View_Batch_Details').modal('show')
    }).catch(function (error) {
        console.log(error);
    });
}