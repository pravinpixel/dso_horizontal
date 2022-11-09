viewBatch = (id) => {
    axios.get(`${APP_URL}/get-material-batch/${id}`).then(function (response) {  
        $('#View_Batch_Details').modal('show');
        document.getElementById('View_Batch_Details_Data').innerHTML = response.data
    }).catch(function (error) {
        console.log(error);
    });
}