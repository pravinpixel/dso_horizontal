app.controller('SearchAddController', function($scope, $http) { 
    // ====For Check Box column Filters ===
        // $scope.on_item_description          =   true;
        // $scope.on_barcode_number            =   true;
        // $scope.on_brand                     =   true;
        // $scope.on_batch                     =   true;
        // $scope.on_serial                    =   true;
        // $scope.on_quantity                  =   true; 
        // // $scope.on_unit_packing_value     =   true; 
        // $scope.storage_area                 =   true; 
        // $scope.housing_type                 =   true; 
        // $scope.on_date_of_expiry            =   true; 
        // $scope.on_iqc_status                =   true; 
        // $scope.on_used_for_td_expt_only     =   true; 
    // ==== END :For Check Box column Filters ===
  

    $scope.filter_status                =   false;
    $scope.advance_search_status        =   false;
    $scope.advance_search_pre_saved     =   true;
    $scope.view_my_saved_search_model   =   false;
    $scope.sort_by_payload              =   false;

    // === Route Lists ===
    var material_products_url               =   $('#get-material-products').val();
    var get_batch_material_products         =   $('#get-batch-material-products').val();
    var get_batch                           =   $('#get-batch').val();
    var get_masters                         =   $('#get_masters').val();
    var edit_material_products_url          =   $('#edit-material-products').val();
    var duplicate_material_products_url     =   $('#duplicate-material-products').val();
    var delete_material_products_url        =   $('#delete-material-products').val();
    var delete_material_products_batch_url  =   $('#delete-material-products-batch').val();
    var get_save_search_url                 =   $('#get-save-search').val();
    var transfer_batch                      =   $('#transfer_batch').val();
    var repack_batch                        =   $('#repack_batch').val();
    var app_URL                             =   $('#app_URL').val();
    $scope.auth_id                          =   $('#auth-id').val();
    $scope.auth_role                        =   $('#auth-role').val(); 
    $scope.current_date                     =   moment(new Date()).format('YYYY-MM-DD')
    $scope.on_all_check_box = false
    
    $scope.select_all_check_box = () => {
        if($scope.on_all_check_box === true) {
            $scope.on_access = true
            $scope.on_alert_before_expiry = true
            $scope.on_alert_threshold_qty_lower_limit = true
            $scope.on_alert_threshold_qty_upper_limit = true
            $scope.on_barcode_number = true
            $scope.on_batch = true
            $scope.on_brand = true
            $scope.on_cas = true
            $scope.on_category_selection = true
            $scope.on_coc_coa_mill_cert = true
            $scope.on_cost_per_unit = true
            $scope.on_date_in = true
            $scope.on_date_of_expiry = true
            $scope.on_date_of_manufacture = true
            $scope.on_date_of_shipment = true
            $scope.on_department = true
            $scope.on_disposal_certificate = true
            $scope.on_euc_material = true
            $scope.on_extended_expiry = true
            $scope.on_extended_qc_result = true
            $scope.on_extended_qc_status = true
            $scope.on_fm_1202 = true
            $scope.on_housing = true
            $scope.on_housing_type = true
            $scope.on_iqc_result = true
            $scope.on_iqc_status = true
            $scope.on_material_product_id = true
            $scope.on_material_product_type = true
            $scope.on_outlife = true
            $scope.on_owner_one = true
            $scope.on_owner_two = true
            $scope.on_packing_size = true
            $scope.on_po_number = true
            $scope.on_project_name = true
            $scope.on_quantity = true
            $scope.on_remarks = true
            $scope.on_repack_size = true
            $scope.on_require_bulk_volume_tracking = true
            $scope.on_require_outlife_tracking = true
            $scope.on_sds = true
            $scope.on_serial = true
            $scope.on_statutory_body = true
            $scope.on_storage_area = true
            $scope.on_supplier = true
            $scope.on_unit_of_measure = true
            $scope.on_unit_packing_value = true
            $scope.on_used_for_td_expt_only = true
        } else {
            $scope.on_access = false
            $scope.on_alert_before_expiry = false
            $scope.on_alert_threshold_qty_lower_limit = false
            $scope.on_alert_threshold_qty_upper_limit = false
            $scope.on_barcode_number = false
            $scope.on_batch = false
            $scope.on_brand = false
            $scope.on_cas = false
            $scope.on_category_selection = false
            $scope.on_coc_coa_mill_cert = false
            $scope.on_cost_per_unit = false
            $scope.on_date_in = false
            $scope.on_date_of_expiry = false
            $scope.on_date_of_manufacture = false
            $scope.on_date_of_shipment = false
            $scope.on_department = false
            $scope.on_disposal_certificate = false
            $scope.on_euc_material = false
            $scope.on_extended_expiry = false
            $scope.on_extended_qc_result = false
            $scope.on_extended_qc_status = false
            $scope.on_fm_1202 = false
            $scope.on_housing = false
            $scope.on_housing_type = false
            $scope.on_iqc_result = false
            $scope.on_iqc_status = false
            $scope.on_material_product_id = false
            $scope.on_material_product_type = false
            $scope.on_outlife = false
            $scope.on_owner_one = false
            $scope.on_owner_two = false
            $scope.on_packing_size = false
            $scope.on_po_number = false
            $scope.on_project_name = false
            $scope.on_quantity = false
            $scope.on_remarks = false
            $scope.on_repack_size = false
            $scope.on_require_bulk_volume_tracking = false
            $scope.on_require_outlife_tracking = false
            $scope.on_sds = false
            $scope.on_serial = false
            $scope.on_statutory_body = false
            $scope.on_storage_area = false
            $scope.on_supplier = false
            $scope.on_unit_of_measure = false
            $scope.on_unit_packing_value = false
            $scope.on_used_for_td_expt_only = false
        }
    }

    // ==== Get Data form DB ====
    $scope.get_material_products =  function () {
        $http({
            method: 'get', 
            url: material_products_url,   
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            
            $scope.material_products.data = $scope.material_products.data?.map((item, index) => {
                var QtyCount = 0
                item.batches.map((batch, bIndex) => {
                   return  QtyCount += Number(batch.quantity)
                }) 
                return {...item , ...{ totalQuantity : QtyCount}};
            })
            $(".custom-table").removeClass('d-none')
        }, function(response) {
            Message('danger', response.data.message);
        });
       
    }
    $scope.get_material_products();

    // ====== Edit & Duplicate Data DB ====

    $scope.editOrDuplicate = function (wizard_mode,id, batch_id , is_parent) { 
        window.location.replace(`${app_URL}/material-product/form-one/${wizard_mode}/${id}/batch/${batch_id}/${is_parent != undefined ? is_parent : ''}`);
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

    $scope.delete_batch_material_product = function (id) {
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
                    url: delete_material_products_batch_url +"/"+id, 
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
            {name: 'EUC material' , item : row.batches[0].euc_material},
            {name: 'Brand' , item : row.batches[0].brand},
            {name: 'Supplier' , item : row.batches[0].supplier},
            {name: 'Unit Packing size' , item : row.unit_packing_value},
            {name: 'Statutory body' , item : row.statutory_body},
            {name: 'Owner 1' , item : row.owner_one},
            {name: 'Owner 2 (SE/PL/FM)' , item : row.owner_two},
            {name: 'Remarks' , item : row.batches[0].remarks},
            {name: 'Alert Threshold Qty for new Lower limit' , item : row.alert_threshold_qty_lower_limit},
            {name: 'Alert Threshold Qty for new Upper  limit' , item : row.alert_threshold_qty_upper_limit},
            {name: 'Alert before expiry (in terms of weeks) for new material/product description' , item : row.alert_before_expiry},
            // {name: 'Access' , item : row.batches[0].access},
        ]
    }

    $scope.view_batch_details = function (row, batch) {
        $http.get(`${get_batch_material_products}/${batch.id}`).then((res) => {
           $('#View_Batch_Details').modal('show');
            $scope.view_batch_details_data  = [
                {name: "Material description", item:row.category_selection == 'in_house' ? 'In-house Product' : 'Material'},
                {name: 'In-house Product description' , item : row.item_description},
                {name: 'EUC material' , item : batch.euc_material == 0 ? "No" : "Yes"},
                {name: 'Cas' , item : batch.cas},
                {name: 'FM1202 (checked if FM1202 is available)' , item : batch.fm_1202},
                {name: 'Upload SDS/Mill Cert Document' , item : batch.sds},
                {name: 'Brand' , item : batch.brand},
                {name: 'Supplier' , item : batch.supplier},
                {name: 'Unit Packing Value' , item : row.unit_packing_value},
                {name: 'Quantity' , item : batch.quantity},
                {name: 'Batch' , item : batch.batch},
                {name: 'Lot# ' , item : ""},
                {name: 'Serial#' , item : ""},
                {name: 'COC/COA/Mill Cert ' , item : batch.coc_coa_mill_cert},
                {name: 'Statutory body' , item : res.data.statutory_body},
                {name: 'Storage area' , item : res.data.storage_area},
                {name: 'Housing type' , item : res.data.housing_type},
                {name: 'Owner 1' , item : batch.owner_one},
                {name: 'Owner 2 (SE/PL/FM)' , item : row.owner_two},
                {name: 'Date in' , item : row.date_in},
                {name: 'Date of expiry' , item : batch.date_of_expiry},
                {name: 'IQC status' , item : batch.iqc_status == 0 ? "Fail" : "Pass"},
                {name: 'IQC result' , item : batch.iqc_result == 0 ? "Fail" : "Pass"},
                {name: 'For product only, can attach COC/COA under IQC.' , item : ""},
                {name: 'PO Number' , item : batch.po_number},
                {name: 'Extended expiry' , item : batch.extended_expiry},
                {name: 'Extended QC status (P/F)' , item : batch.extended_qc_status},
                {name: 'Extended QC result' , item : batch.extended_qc_result},
                {name: 'Disposed ' , item : ""},
                {name: 'Upload disposal certificate' , item : batch.disposal_certificate},
                {name: 'Project name' , item : batch.project_name},
                {name: 'Remarks' , item : batch.remarks},
                {name: 'Alert Threshold Qty for new material/product description (red amber green indicator to reflect quantity health status) (All owner 1/2 to receive notification)' , item : ""},
                {name: 'Alert before expiry (in terms of weeks) for new material/product description (red amber green indicator to warn owners on near expiry items) (All owner 1/2 to receive notification)' , item : ""},
                {name: 'department' , item : res.data.department},
                {name: 'Material/Product type' , item : batch.material_product_type},
                {name: 'Cost per unit' , item : batch.cost_per_unit},
                {name: 'Access' , item : res.data.access.join(",") },
            ]
        });
    }
 
    //  ===== Pagination & Filters ====
    $scope.next_Prev_page = function (params) {
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

        $http({
            method: 'post', 
            url: params,
            data : payload_data 
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            $scope.material_products.data = $scope.material_products.data?.map((item, index) => {
                var QtyCount = 0
                item.batches.map((batch, bIndex) => {
                   return  QtyCount += Number(batch.quantity)
                }) 
                return {...item , ...{ totalQuantity : QtyCount}};
            })
        }, function(response) {
            Message('danger', response.data.message);
        });  
    }

    $scope.sort_by = function (name, type) {
        console.log(type)
        $scope.sort_by_payload      =   true;
        $scope.sort_by_payload_data =   {
            sort_by: {
                col_name    :  name ,
                order_type  :  type ,
            }
        }
         
        $http({
            method  :   'post', 
            url     :   material_products_url,
            data    :   $scope.sort_by_payload_data
        }).then(function(response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            $scope.material_products.data = $scope.material_products.data?.map((item, index) => {
                var QtyCount = 0
                item.batches.map((batch, bIndex) => {
                   return  QtyCount += Number(batch.quantity)
                }) 
                return {...item , ...{ totalQuantity : QtyCount}};
            })
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
            $scope.material_products.data = $scope.material_products.data?.map((item, index) => {
                var QtyCount = 0
                item.batches.map((batch, bIndex) => {
                   return  QtyCount += Number(batch.quantity)
                }) 
                return {...item , ...{ totalQuantity : QtyCount}};
            })
        }, function(response) {
            Message('danger', response.data.message);
        });
    } 
 

    $scope.clear_advanced_filter = () => {
        $scope.advanced_filter  =   {}
    }

    // Advanced Search Fitters
    $scope.search_advanced_mode = (advanced_search, type) => { 
      
        $scope.filter_status            =   true
        $scope.sort_by_payload          =   false;
        if (advanced_search === undefined) { 
            $scope.filler_function();
            var payload_data                =   $scope.filter_data 
            $scope.advance_search_status    =   true 
        }  else {
            $scope.advance_search_pre_saved         =   true 
            $scope.advance_search_pre_saved_data    =   advanced_search
            var payload_data   =  $scope.advanced_filter
        }
        if (type == 'saved_search') {
            var payload_data = {
                advanced_search : advanced_search
            }
        }

        Object.keys(payload_data.advanced_search).map((item) => {
            if(
                item == "date_in" || item == "date_of_expiry" || item == "date_of_manufacture" || item == "date_of_shipment"
            ) {
                payload_data.advanced_search[item].startDate  =  moment(payload_data.advanced_search[item].startDate).format('YYYY-MM-DD')
                payload_data.advanced_search[item].endDate    =  moment(payload_data.advanced_search[item].endDate).format('YYYY-MM-DD')
            }
        })

        $http({
            method: 'post',
            url: material_products_url,
            data :  payload_data
        }).then(function(response) {
            $scope.material_products    =   response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            $scope.material_products.data = $scope.material_products.data?.map((item, index) => {
                var QtyCount = 0
                item.batches.map((batch, bIndex) => {
                   return  QtyCount += Number(batch.quantity)
                }) 
                return {...item , ...{ totalQuantity : QtyCount}};
            })
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
            $scope.filter               =   ""
        // ====Bulk Search Rest===
        delete $scope.filter_data 
        $scope.clear_advanced_filter()
    } 

    $scope.filler_function =   () => {
        if($scope.filter_status == true) {
            $scope.filter_data  =   {
                advanced_search:  $scope.advanced_filter
            }
        }   else {
            $scope.filter_data  =   {}
        }
    }
    $scope.filler_function();
 
    $scope.save_search_title    = () => {
        if($scope.search_title === undefined ) {
            Message('danger', "Search Title is Required !");
            return false
        }
   
        $http({
            method: 'post', 
            url: get_save_search_url,
            data : {data : $scope.advanced_filter , search_title :  $scope.search_title}
        }).then(function(response) {
            $scope.material_products = response.data.data;
            Message('success', response.data.message);
            $scope.search_title = ''
            $('#save-search-name').modal('hide');
            $('#saveThisSearch').prop('checked', false);
        }, function(response) {
            Message('danger', response.data.errors.search_title[0]);
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
    $scope.removeSearchRecord = (id) => {
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
                    method: 'DELETE', 
                    url: get_save_search_url +"/" + id  
                }).then(function(response) {
                    $http({
                        method: 'get', 
                        url: get_save_search_url,  
                    }).then(function(response) {
                        $scope.view_my_saved_search_list = response.data.data; 
                    });
                    Message('success', response.data.message);
                });
            } 
        });  
    }

    $http.get(get_masters).then((res)   => {
        $scope.MasterData = res.data
    });

    $scope.Transfers = (id, quantity) => {
        $http.get(`${get_batch}/${id}`).then((response) => {
            $scope.TransfersBatch               =   response.data 
            $scope.TransfersBatchMaxQuantity    =   response.data.quantity
            $('#Transfers').modal('show');
        });
    } 
    $scope.transferBatch = () => {
        if($scope.TransfersBatch.quantity == '' || $scope.TransfersBatch.storage_area == '' || $scope.TransfersBatch.housing_type == '' || $scope.TransfersBatch.housing   == '' || $scope.TransfersBatch.owner_one == '' || $scope.TransfersBatch.owner_two == '') {
            Message('danger', "All fields is Required !");
            return false
        } 
        if($scope.TransfersBatch.quantity == null || $scope.TransfersBatch.storage_area == null || $scope.TransfersBatch.housing_type == null || $scope.TransfersBatch.housing   == null || $scope.TransfersBatch.owner_one == null || $scope.TransfersBatch.owner_two == null) {
            Message('danger', "All fields is Required !");
            return false
        } 
        $http.post(transfer_batch, $scope.TransfersBatch).then((response) => {
            $scope.get_material_products();
            Message('success', response.data.message);
            $('#Transfers').modal('hide');
        });
    }
    $scope.clearTransferBatch = () => {
        swal({
            text: "Do you want to clear fields ?",
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
                    text: "Yes! Delete",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            }, 
        }).then((isConfirm) => {
            if(isConfirm) {
                $scope.TransfersBatch.quantity      = ''
                $scope.TransfersBatch.storage_area  = ''
                $scope.TransfersBatch.housing_type  = ''
                $scope.TransfersBatch.housing       = ''
                $scope.TransfersBatch.owner_one     = ''
                $scope.TransfersBatch.owner_two     = ''
                $scope.$apply()
            } 
        });
    }

    // Repack And Transfer 
    $scope.CurrentDate = new Date();

    $scope.RepackTransfers = (type,batch, row) => {
        switch (type) {
            case "view":
                $("#RepackTransfers").modal("show");
                $scope.RepackTransfer           =   batch;
                $scope.RepackTransferPackSize   =   row.unit_packing_value
                $scope.RepackTransferMeasure    =   row.unit_of_measure[0].name
                const CurrentAccessed           =   JSON.parse($scope.RepackTransfer.access);
                $scope.CurrentAccessed          =   CurrentAccessed.join() 
            break;
            case "store" :
                if($scope.RepackTransfer.PackingSize === null || $scope.RepackTransfer.PackingSize === undefined) {
                    Message('danger', "Input Used amt (L) is Required !");
                    return false;
                }
                if($scope.RepackTransfer.repack_size == ''|| $scope.RepackTransfer.quantity == '' || $scope.RepackTransfer.storage_area == '' || $scope.RepackTransfer.housing_type == '' || $scope.RepackTransfer.housing   == '' || $scope.RepackTransfer.owner_one == '' || $scope.RepackTransfer.owner_two == '') {
                    Message('danger', "All fields is Required !");
                    return false
                } 
                if($scope.RepackTransfer.repack_size == null || $scope.RepackTransfer.quantity == null || $scope.RepackTransfer.storage_area == null || $scope.RepackTransfer.housing_type == null || $scope.RepackTransfer.housing   == null || $scope.RepackTransfer.owner_one == null || $scope.RepackTransfer.owner_two == null) {
                    Message('danger', "All fields is Required !");
                    return false
                }
                $http.post(repack_batch, $scope.RepackTransfer).then((response) => {
                    $scope.get_material_products();
                    Message(response.data.status == true ? 'success' : 'danger', response.data.message);
                    
                    $('#RepackTransfers').modal('hide');
                }); 
            break;
            case "clear" :
                swal({
                    text: "Do you want to clear fields ?",
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
                            text: "Yes! Delete",
                            value: true,
                            visible: true,
                            className: "btn btn-danger rounded-pill",
                            closeModal: true
                        }
                    }, 
                }).then((isConfirm) => {
                    if(isConfirm) {
                        $scope.RepackTransfer.quantity = ''
                        $scope.RepackTransfer.storage_area = ''
                        $scope.RepackTransfer.housing_type = ''
                        $scope.RepackTransfer.housing   = ''
                        $scope.RepackTransfer.owner_one = ''
                        $scope.RepackTransfer.owner_two = ''
                        $scope.$apply()
                    } 
                });
                break;
            default: break;
        }
    }

    // Print Barcode
    $scope.view_print_barcode = (id) => {
        window.location.href =  `print-label/${id}`
    } 
    $scope.printBatchLabel = (id) => {
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
        }).then((isConfirm) => {
            if(isConfirm) {
                window.location.href =  `print-label/${id}`
            } 
        });
    } 
    // New Repack Outlife eFlow 
    $scope.repack_outlife_table = [];
    $scope.disable_repack_outlife = false 

    $scope.RepackOutlife  = (batch, unit_of_measure) => {  
        $scope.repack_outlife_unit_of_measure   =   unit_of_measure.name
        $scope.repack_outlife_days              =   batch.outlife
        $scope.currentBatchId                   =   batch.id
        $scope.currentBatch                     =   batch
        $http.get(`repack-batch/${batch.id}`).then((response) => {
            $scope.repack_outlife_table.length = 0;
            const RepackData = response.data 
           
            addNewRepackOutlife = () => {
                $scope.repack_outlife_table.push({
                    id : null,
                    draw_in  : {
                        status      : 1 == 1 ? true : false,
                        time_stamp  : null
                    },
                    draw_out : {
                        status      : 0 == 1 ? true : false,
                        time_stamp  : null
                    },
                    last_access     : JSON.parse(RepackData.access),
                    initial_amount  : RepackData.quantity,
                    repack_amount   : null,
                    balance_amount  : null,
                    repack_size     : null,
                    qty_cut         : null,
                    remaining_days  : null,
                });
            }
            if(RepackData.repack_outlife.length !== 0) { 
                if(RepackData.repack_outlife.at(-1).draw_out == 0 && RepackData.repack_outlife.at(-1).draw_in == 0 &&  RepackData.repack_outlife.at(-1).quantity == 0) {
                    $scope.disable_repack_outlife = true 
                }
                RepackData.repack_outlife.forEach(element => {
                    $scope.repack_outlife_table.push(
                        {
                            id : element.id,
                            draw_in  : {
                                status      : element.draw_in == 1 ? true : false,
                                time_stamp  : element.draw_in_time_stamp
                            },
                            draw_out : {
                                status      : element.draw_out == 1 ? true : false,
                                time_stamp  : element.draw_out_time_stamp
                            },
                            last_access     : JSON.parse(RepackData.access),
                            initial_amount  : element.quantity,
                            repack_amount   : element.input_repack_amount,
                            balance_amount  : element.remain_amount,
                            repack_size     : element.repack_size,
                            qty_cut         : element.qty_cut,
                            remaining_days  : element.remain_days,
                        }
                    );
                })
                if(RepackData.repack_outlife.at(-1).draw_in != 0 
                    &&  RepackData.repack_outlife.at(-1).draw_out != 0) {
                    if(RepackData.repack_outlife.at(-1).quantity != 0) {
                        addNewRepackOutlife()
                    } else {
                        $scope.disable_repack_outlife = true
                    }
                } else {
                    if(RepackData.repack_outlife.at(-1).draw_out == 0) {
                        if(RepackData.repack_outlife.at(-1).quantity != 0) {
                            addNewRepackOutlife()
                        }
                    }
                }
             
            }  else {
                addNewRepackOutlife()
            } 
            $('#RepackOutlife').modal('show');
        }) 
    }
  
    $scope.next_draw = false
    $scope.saveRepackOutlife = () => {
        if($scope.repackOutlifeForm.$invalid){
            Message('danger', "Input value is Required!")
            return false
        }
        $http.post(`store-repack-batch/${$scope.currentBatchId}`,$scope.repack_outlife_table)
        .then((response) => {
            $scope.next_draw = response.data.new_draw_in
            $http.get(`repack-batch/${$scope.currentBatchId}`).then((response) => {
                const  RepackData = response.data 
                $scope.repack_outlife_table.length = 0;
                if(RepackData.repack_outlife.length !== 0) { 
                    RepackData.repack_outlife.forEach(element => {
                        $scope.repack_outlife_table.push(
                            {
                                id : element.id,
                                draw_in  : {
                                    status      : element.draw_in == 1 ? true : false,
                                    time_stamp  : element.draw_in_time_stamp
                                },
                                draw_out : {
                                    status      : element.draw_out == 1 ? true : false,
                                    time_stamp  : element.draw_out_time_stamp
                                },
                                last_access     : JSON.parse(RepackData.access),
                                initial_amount  : element.quantity,
                                repack_amount   : element.input_repack_amount,
                                balance_amount  : element.remain_amount,
                                repack_size     : element.repack_size,
                                qty_cut         : element.qty_cut,
                                remaining_days  : element.remain_days,
                            }
                        );
                    })
                } else { 
                    $scope.repack_outlife_table.push({
                        id : null,
                        draw_in  : {
                            status      : true,
                            time_stamp  : null
                        },
                        draw_out : {
                            status      : false,
                            time_stamp  : null
                        },
                        last_access     : JSON.parse(RepackData.access),
                        initial_amount  : RepackData.quantity,
                        repack_amount   : null,
                        balance_amount  : null,
                        repack_size     : null,
                        qty_cut         : null,
                        remaining_days  : null,
                    });
                }
                if($scope.next_draw == true) { 

                    var newRow = true

                    $scope.repack_outlife_table.forEach(element => {
                        console.log(element.balance_amount)
                        if(element.balance_amount == 0) {
                            newRow = false
                        }
                    })
                 
                    newRow === true && $scope.repack_outlife_table.push({
                        id : null,
                        draw_in  : {
                            status      : true,
                            time_stamp  : null
                        },
                        draw_out : {
                            status      : false,
                            time_stamp  : null
                        },
                        last_access     : JSON.parse(RepackData.access),
                        initial_amount  : RepackData.quantity,
                        repack_amount   : null,
                        balance_amount  : null,
                        repack_size     : null,
                        qty_cut         : null,
                        remaining_days  : null,
                    });
                } 
                Message('success',"Repack Outlife Saved !")
            }) 
            if($('#exportLogCheckBox').is(':checked')) {
                location.replace(`export-repack-batch/${$scope.currentBatchId}`);
                $('#exportLogCheckBox').prop('checked', false)
            }
            $('#RepackOutlife').modal('hide');
        })
    }
}); 