var app = angular.module('PrintLabelApp', []);
app.controller("PrintController", ($scope, $http) => {
    $scope.Barcode          = true
    $scope.date_of_shipment = true
    $scope.owners           = true
    $scope.item_description = true
    $scope.date_of_expiry   = true
    $scope.batch_id         = true

    $scope.confirmGHS = () => {
        $("#GHSPictogramMenu").hide();
        $scope.GHSPictogram = true
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
                @font-face {
                    font-family: 'barcode font';
                    font-style: normal;
                    font-weight: 400;
                    src: local('barcode font'), url('https://fonts.cdnfonts.com/s/10997/BarcodeFont.woff') format('woff');
                }   
                @media print {
                    html, body {
                       border: 1px solid white;
                       height: 99%;
                       page-break-after: avoid;
                       page-break-before: avoid;
                       font-weight : bold !important
                    }
               }
                @media print, screen {
                    small {
                        font-size:20px !important
                    }
                    .badge {
                        border: 1px solid black;
                        padding: 1px 5px;
                        border-radius: 10px;
                        margin: 5px;
                        line-height: 38px;
                        color:black !important
                    }
                    .print-card {
                        border  :   1px solid gray !important;
                        background  :   white;
                        padding : 30px;
                        text-align:center;
                        border-radius:15px;
                        width: ${$scope.print_size == 'small' ? '341px' : '548px'};
                        clear: both;
                        page-break-after: always;
                        font-size:20px !important
                    }
                    .print-border {
                        padding-top : 20px; 
                        margin-top : 20px;
                        border-top:1px solid gray 
                    }
                    .print-card-wrapper {
                        min-height: 95vh;
                        display: flex;
                        align-items: center;
                        justify-content: center;
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
                    .barcode_label {
                        font-family: 'barcode font', Courier;
                        font-size: 68px !important;
                        color: black !important;
                        letter-spacing: 3px;
                        margin-bottom: 15px !important
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
 