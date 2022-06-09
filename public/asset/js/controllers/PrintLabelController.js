var app = angular.module('PrintLabelApp', []);
app.controller("PrintController", ($scope, $http) => {
    $scope.Barcode                  = true
    $scope.date_of_shipment         = true
    $scope.ownners                  = true
    $scope.item_description         = true
    $scope.date_of_expiry           = true
    $scope.batch_id                 = true
    $scope.used_for_td_expt_only    = true

    $scope.confirmGHS = () => {
        $("#GHSPictogramMenu").hide();
        $scope.GHSPictogram = true
    } 
    $scope.removeGHS = () => {
        $('#printImages img').remove()
        $scope.GHSPictogram = false
    } 
    $scope.printBarcodeLabel = () => {
        if($scope.print_qty == '' || $scope.print_qty == undefined || $scope.print_qty === null) {
            Message('danger', "Print Qty is Required !");
            return false
        }
        if($scope.print_size == '' || $scope.print_size == undefined || $scope.print_size === null) {
            Message('danger', "Print size is Required !");
            return false
        }
        $( "#printBox div").remove()
        for (let index = 0; index < $scope.print_qty; index++) { 
            $( "#printableBarcodeLabel").clone().appendTo("#printBox" );
        }
        var a = window.open('', '', 'height=10000, width=10000');
        a.document.write('<html>');
        a.document.write('<body>');
        a.document.write(`
            <style>
                @media print, screen {
                    #Print-btn{
                        display:none
                    }
                    #printableBarcodeLabel {
                        display:flex;
                        justify-content:center;
                        align-items:center;
                        min-height:100vh
                    }
                    .print-card{
                        border  :   1px solid gray !important;
                        background  :   white;
                        padding : 30px;
                        margin  :30px auto;
                        text-align:center;
                        border-radius:15px;
                        width: ${$scope.print_size == 'small' ? '350px' : '650px'};
                        clear: both;
                        page-break-after: always;
                    }
                    .print-border {
                        padding-top : 20px; 
                        margin-top : 20px;
                        border-top:1px solid gray 
                    }
                    .text-end {
                        text-align:right;
                    }
                    .print-badge {
                        color:white !important;
                        background-color:#474D56 !important;
                        border-radius:10px;
                        font-size:12px;
                        padding:0 5px;
                        font-weight:bold !important
                    }
                    #printImages img {
                        width:100px !important
                    }
                }
            </style>
        `);
        a.document.write($("#printBox").html());
        a.document.write('</html>');
        a.document.close();
        a.print();
    }

    $("#GHSPictogramMenu").hide();
    $scope.GHSPictogramMenu = () => {
        $("#GHSPictogramMenu").show();
    }
    
})
function changeGhsDiagram(id) {
    $('#printImages img').remove()
    $(`#${id}`).clone().appendTo("#printImages")
}