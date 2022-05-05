app.controller('SearchAddController', function($scope, $http) { 
  
    // ====For Check Box column Filters ===
    $scope.on_item_description          =   true;
    $scope.on_brand                     =   true;
    $scope.on_batch                     =   true;
    $scope.on_unit_packing_size         =   true;
    $scope.on_quantity                  =   true; 
    $scope.on_owner_one                 =   true; 
    $scope.on_storage_room              =   true; 
    $scope.on_house_type                =   true; 
    $scope.on_date_of_expiry            =   true; 
    $scope.on_iqc_status                =   true; 
    $scope.on_used_for_td               =   true; 
    $scope.filter_status                =   false;
    $scope.bulk_search_status           =   false;
    $scope.advance_search_status        =   false;
    $scope.advance_search_pre_saved     =   true;
    $scope.view_my_saved_search_model   =   false;
    $scope.sort_by_payload              =   false;

    // === Route Lists ===
    var material_products_url           =   $('#get-material-products').val();
    var edit_material_products_url      =   $('#edit-material-products').val();
    var delete_material_products_url    =   $('#delete-material-products').val();
    var get_save_search_url             =   $('#get-save-search').val();
    $scope.auth_id                      =   $('#auth-id').val();
    $scope.auth_role                    =   $('#auth-role').val();
    

    // ==== Get Data form DB ====
    $scope.get_material_products =  function () {
        $http({
            method: 'get', 
            url: material_products_url,  
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function(response) {
            Message('danger', response.data.message);
        });
    }
    $scope.get_material_products();

    // ====== Edit Data DB ====

    $scope.edit_material_product = function (id, batch_id) {
        window.location.replace(`${edit_material_products_url}/form-one/${id}/${batch_id}`);
    }

    // ====== Delete Data DB ====
    $scope.delete_material_product = function (id) {
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
            if(isConfirm) {
                $http({
                    method: 'POST', 
                    url: delete_material_products_url +"/"+id, 
                }).then(function(response) {
                    $scope.data = response.data; 
                    $scope.get_material_products();
                    Message('success', response.data.message); 
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            } 
        });
    }

    $scope.view_material_product = function (row) {
        $('#View_Material_Product_Details').modal('show'); 
        $scope.view_material_product_data  = [
            {name: "Category Selection", item:row.category_selection == 'in_house' ? 'In-house Product' : 'Material'},
            {name: 'Item description' , item : row.item_description},
            {name: 'In-house Product Logsheet ID#' , item : row.in_house_product_logsheet_id},
            {name: 'EUC material' , item : row.euc_material},
            {name: 'Brand' , item : row.brand},
            {name: 'Supplier' , item : row.supplier},
            {name: 'Unit Packing size' , item : row.unit_packing_size},
            {name: 'Statutory body' , item : row.statutory_body},
            {name: 'Owner 1' , item : row.owner_one},
            {name: 'Owner 2 (SE/PL/FM)' , item : row.owner_two},
            {name: 'Remarks' , item : row.remarks},
            {name: 'Alert Threshold Qty for new material/product description' , item : row.alert_threshold_qty_for_new},
            {name: 'Alert before expiry (in terms of weeks) for new material/product description' , item : row.alert_before_expiry},
            {name: 'Access' , item : row.access},
        ]
    }
 
    //  ===== Pagination & Filters ====
    $scope.next_Prev_page = function (params) {
        if($scope.bulk_search_status  == true) {
            var payload_data    =   {   
                bulk_search: {
                    item_description    :  $scope.filter.item_description    == undefined ? null : $scope.filter.item_description,
                    category_selection  :  $scope.filter.category_selection  == undefined ? null : $scope.filter.category_selection,
                    brand               :  $scope.filter.brand               == undefined ? null : $scope.filter.brand,
                    owner               :  $scope.filter.owner               == undefined ? null : $scope.filter.owner,
                    dept                :  $scope.filter.dept                == undefined ? null : $scope.filter.dept,
                    storage_area        :  $scope.filter.storage_area        == undefined ? null : $scope.filter.storage_area,
                    date_in             :  $scope.filter.date_in             == undefined ? null : moment($scope.filter.date_in).format('YYYY-MM-DD'),
                }
            }
        }  else {
            if ($scope.advance_search_status == true) {
                var payload_data = $scope.filter_data;
            } else {
                if ($scope.advance_search_pre_saved == true) {
                    var payload_data = { advanced_search : $scope.advance_search_pre_saved_data}
                }
                if ($scope.sort_by_payload == true) {
                    var payload_data = $scope.sort_by_payload_data
                } else {
                    var payload_data    =   {Empty : "0000"}
                }
            }
        }

        $http({
            method: 'post', 
            url: params,
            data : payload_data 
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function(response) {
            Message('danger', response.data.message);
        });  
    }

    $scope.sort_by = function (name, type) {
        $scope.sort_by_payload      =   true;
        $scope.sort_by_payload_data =   {
            sort_by: {
                col_name    :  name ,
                order_type  :  type ,
            }
        }
         
        $http({
            method: 'post', 
            url: material_products_url,
            data :  $scope.sort_by_payload_data
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function(response) {
            Message('danger', response.data.message);
        });
    }

    $scope.search_barcode_number = function () {
        $http({
            method: 'post', 
            url: material_products_url,
            data : {
                filters: $scope.barcode_number
            }
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function(response) {
            Message('danger', response.data.message);
        });
    } 

    $scope.bulk_search = function () {
        $scope.filter_status        =   true
        $scope.bulk_search_status   =   true;
        $scope.sort_by_payload      =   false;
        $http({
            method: 'post', 
            url: material_products_url,
            data : {
                bulk_search: {
                    item_description    :  $scope.filter.item_description    == undefined ? null : $scope.filter.item_description,
                    category_selection  :  $scope.filter.category_selection  == undefined ? null : $scope.filter.category_selection,
                    brand               :  $scope.filter.brand               == undefined ? null : $scope.filter.brand,
                    owner               :  $scope.filter.owner               == undefined ? null : $scope.filter.owner,
                    dept                :  $scope.filter.dept                == undefined ? null : $scope.filter.dept,
                    storage_area        :  $scope.filter.storage_area        == undefined ? null : $scope.filter.storage_area,
                    date_in             :  $scope.filter.date_in             == undefined ? null : moment($scope.filter.date_in).format('YYYY-MM-DD'),
                }
            }
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function(response) {
            Message('danger', response.data.message);
        });
    }
     
    // Advanced Search Fitters
    $scope.search_advanced_mode = (advanced_search) => { 

        $scope.filter_status            =   true
        $scope.sort_by_payload          =   false;
        $scope.bulk_search_status       =   false
        if (advanced_search === undefined) { 
            $scope.filler_function();
            var payload_data                = $scope.filter_data 
            $scope.advance_search_status    = true 
        }  else {
            $scope.advance_search_pre_saved         =   true 
            $scope.advance_search_pre_saved_data    =   advanced_search
            var payload_data   =  {advanced_search} 
        }
        $http({
            method: 'post',
            url: material_products_url,
            data :  payload_data
        }).then(function(response) {
         
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            
            $('#advance-search-ng-modal').modal('hide');

            if ($scope.view_my_saved_search_model  ==  true) {
                $('#saved-search-ng-modal').modal('hide');
            }
             
        }, function(response) {
            Message('danger', response.data.message);
        });
    }
  
    $scope.reset_bulk_search = function () {
        $scope.get_material_products();

        $scope.filter_status            =   false;
        $scope.advance_search_status    =   false;
        $scope.sort_by_payload          =   false;

        // ====Bulk Search Rest====
            $scope.bulk_search_status           =   false
            $scope.filter.item_description      =   " "
            $scope.filter.category_selection    =   " "
            $scope.filter.brand                 =   " "
            $scope.filter.owner                 =   " "
            $scope.filter.dept                  =   " "
            $scope.filter.storage_area          =   " "
            $scope.filter.date_in               =   " "
        // ====Bulk Search Rest===
        delete $scope.filter_data 
    } 

    $scope.filler_function =   () => {
        if($scope.filter_status == true) {
            $scope.filter_data  =   {
                advanced_search: {
                    af_logsheet_id         : $scope.af_logsheet_id          ==  undefined ? null : $scope.af_logsheet_id, 
                    af_euc_material        : $scope.af_euc_material         ==  undefined ? null : $scope.af_euc_material, 
                    af_cas                 : $scope.af_cas                  ==  undefined ? null : $scope.af_cas, 
                    af_supplier            : $scope.af_supplier             ==  undefined ? null : $scope.af_supplier, 
                    af_batch               : $scope.af_batch                ==  undefined ? null : $scope.af_batch, 
                    af_serial              : $scope.af_serial               ==  undefined ? null : $scope.af_serial, 
                    af_statutory_board     : $scope.af_statutory_board      ==  undefined ? null : $scope.af_statutory_board, 
                    af_housing_type        : $scope.af_housing_type         ==  undefined ? null : $scope.af_housing_type, 
                    af_housing_number      : $scope.af_housing_number       ==  undefined ? null : $scope.af_housing_number, 
                    af_unit_pkt_size       : $scope.af_unit_pkt_size        ==  undefined ? null : $scope.af_unit_pkt_size, 
                    af_date_of_expiry      : $scope.af_date_of_expiry       ==  undefined ? null : moment($scope.af_date_of_expiry).format('YYYY-MM-DD'), 
                    af_iqc_status          : $scope.af_iqc_status           ==  undefined ? null : $scope.af_iqc_status, 
                    af_po_number           : $scope.af_po_number            ==  undefined ? null : $scope.af_po_number, 
                    af_extended_expiry     : $scope.af_extended_expiry      ==  undefined ? null : moment($scope.af_extended_expiry).format('YYYY-MM-DD'), 
                    af_extended_qc_status  : $scope.af_extended_qc_status   ==  undefined ? null : $scope.af_extended_qc_status, 
                    af_disposed            : $scope.af_disposed             ==  undefined ? null : $scope.af_disposed, 
                    af_project_name        : $scope.af_project_name         ==  undefined ? null : $scope.af_project_name, 
                    af_product_type        : $scope.af_product_type         ==  undefined ? null : $scope.af_product_type, 
                    af_date_of_shipment    : $scope.af_date_of_shipment     ==  undefined ? null : moment($scope.af_date_of_shipment).format('YYYY-MM-DD'), 
                    af_date_of_manufacture : $scope.af_date_of_manufacture  ==  undefined ? null : moment($scope.af_date_of_manufacture).format('YYYY-MM-DD'),
                    af_usage_tracking      : $scope.af_usage_tracking       ==  undefined ? null : $scope.af_usage_tracking, 
                    af_outlife_tracking    : $scope.af_outlife_tracking     ==  undefined ? null : $scope.af_outlife_tracking, 
                }
            }
        }   else {
            $scope.filter_data  =   {}
        }
    }
    $scope.filler_function();
 
    $scope.save_search_title    = () => {
        var inputs =   {
            title : $scope.search_title,
            advanced_search: {
                af_logsheet_id         : $scope.af_logsheet_id          ==  undefined   ?   null   :   $scope.af_logsheet_id, 
                af_euc_material        : $scope.af_euc_material         ==  undefined   ?   null   :   $scope.af_euc_material, 
                af_cas                 : $scope.af_cas                  ==  undefined   ?   null   :   $scope.af_cas, 
                af_supplier            : $scope.af_supplier             ==  undefined   ?   null   :   $scope.af_supplier, 
                af_batch               : $scope.af_batch                ==  undefined   ?   null   :   $scope.af_batch, 
                af_serial              : $scope.af_serial               ==  undefined   ?   null   :   $scope.af_serial, 
                af_statutory_board     : $scope.af_statutory_board      ==  undefined   ?   null   :   $scope.af_statutory_board, 
                af_housing_type        : $scope.af_housing_type         ==  undefined   ?   null   :   $scope.af_housing_type, 
                af_housing_number      : $scope.af_housing_number       ==  undefined   ?   null   :   $scope.af_housing_number, 
                af_unit_pkt_size       : $scope.af_unit_pkt_size        ==  undefined   ?   null   :   $scope.af_unit_pkt_size, 
                af_date_of_expiry      : $scope.af_date_of_expiry       ==  undefined   ?   null   :   moment($scope.af_date_of_expiry).format('YYYY-MM-DD'), 
                af_iqc_status          : $scope.af_iqc_status           ==  undefined   ?   null   :   $scope.af_iqc_status, 
                af_po_number           : $scope.af_po_number            ==  undefined   ?   null   :   $scope.af_po_number, 
                af_extended_expiry     : $scope.af_extended_expiry      ==  undefined   ?   null   :   moment($scope.af_extended_expiry).format('YYYY-MM-DD'), 
                af_extended_qc_status  : $scope.af_extended_qc_status   ==  undefined   ?   null   :   $scope.af_extended_qc_status, 
                af_disposed            : $scope.af_disposed             ==  undefined   ?   null   :   $scope.af_disposed, 
                af_project_name        : $scope.af_project_name         ==  undefined   ?   null   :   $scope.af_project_name, 
                af_product_type        : $scope.af_product_type         ==  undefined   ?   null   :   $scope.af_product_type, 
                af_date_of_shipment    : $scope.af_date_of_shipment     ==  undefined   ?   null   :   moment($scope.af_date_of_shipment).format('YYYY-MM-DD'), 
                af_date_of_manufacture : $scope.af_date_of_manufacture  ==  undefined   ?   null   :   moment($scope.af_date_of_manufacture).format('YYYY-MM-DD'),
                af_usage_tracking      : $scope.af_usage_tracking       ==  undefined   ?   null   :   $scope.af_usage_tracking, 
                af_outlife_tracking    : $scope.af_outlife_tracking     ==  undefined   ?   null   :   $scope.af_outlife_tracking, 
            }
        }
 
        $http({
            method: 'post', 
            url: material_products_url,
            data : {save_advanced_search : inputs}

        }).then(function(response) {
            $scope.material_products = response.data.data;
            Message('success', response.data.message);
            $scope.search_title = ''
            $('#save-search-name').modal('hide');
        }, function(response) {
            Message('danger', response.data.message);
        });
    }

    $scope.view_my_saved_search =   () => {
        $scope.view_my_saved_search_model   =   true
        $("#saved-search-ng-modal").modal('show')
        $http({
            method: 'get', 
            url: get_save_search_url,  
        }).then(function(response) {
            $scope.view_my_saved_search_list = response.data.data; 
        });
    }
});