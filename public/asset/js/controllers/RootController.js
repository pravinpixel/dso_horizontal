app.controller('RootController', function ($scope, $http) {

    $scope.withdrawalStatus           = false
    $scope.filter_status              = false
    $scope.advance_search_status      = false
    $scope.advance_search_pre_saved   = true
    $scope.view_my_saved_search_model = false
    $scope.sort_by_payload            = false
    $scope.advanced_filter            = {}

    // === Route Lists ===
    var material_products_url              = $('#get-material-products').val();
    var material_products_export           = $('#get-material-export').val();
    var material_products_document         = $('#get-material-document').val();
    var change_batch_read_status           = $('#change_batch_read_status').val();
    var get_batch_material_products        = $('#get-batch-material-products').val();
    var get_batch                          = $('#get-batch').val();
    var get_masters                        = $('#get_masters').val();
    var pageName                           = $('#page-name').val();
    var duplicate_material_products_url    = $('#duplicate-material-products').val();
    var delete_material_products_url       = $('#delete-material-products').val();
    var delete_material_products_batch_url = $('#delete-material-products-batch').val();
    var get_save_search_url                = $('#get-save-search').val();
    var transfer_batch                     = $('#transfer_batch').val();
    var repack_batch                       = $('#repack_batch').val();
    var app_URL                            = $('#app_URL').val();
        $scope.auth_id                     = $('#auth-id').val();
        $scope.auth_role                   = $('#auth-role').val();
        $scope.current_date                = moment(new Date()).format('YYYY-MM-DD')
        $scope.on_all_check_box            = false

    $scope.getDateOfExpiryColor = (current_date, date_of_expiry) => {
        var given = moment(date_of_expiry.replaceAll('/', '-'), "YYYY-MM-DD");
        var day = moment.duration(given.diff(current_date)).asDays();
        if (current_date >= given) {
            return 'text-danger'
        } else {
            if (day < 21) { // 21 ---> 3 weeks
                return 'text-warning'
            }
            if (day > 21) { // 21 ---> 3 weeks
                return 'text-success'
            }
        }
    }

    $scope.on_barcode_number = false
    $scope.select_all_check_box = () => {
        if ($scope.on_all_check_box === true) {
            $scope.on_access                          = true
            $scope.on_alert_before_expiry             = true
            $scope.on_alert_threshold_qty_lower_limit = true
            $scope.on_alert_threshold_qty_upper_limit = true
            $scope.on_barcode_number                  = true
            $scope.on_batch                           = true
            $scope.on_brand                           = true
            $scope.on_cas                             = true
            $scope.on_category_selection              = true
            $scope.on_coc_coa_mill_cert               = true
            $scope.on_cost_per_unit                   = true
            $scope.on_date_in                         = true
            $scope.on_disposed_after                  = true
            $scope.on_date_of_expiry                  = true
            $scope.on_date_of_manufacture             = true
            $scope.on_date_of_shipment                = true
            $scope.on_department                      = true
            $scope.on_disposal_certificate            = true
            $scope.on_euc_material                    = true
            $scope.on_extended_expiry                 = true
            $scope.on_extended_qc_result              = true
            $scope.on_extended_qc_status              = true
            $scope.on_fm_1202                         = true
            // $scope.on_housing = true
            $scope.on_housing_type          = true
            $scope.on_iqc_result            = true
            $scope.on_iqc_status            = true
            $scope.on_material_product_id   = true
            $scope.on_material_product_type = true
            $scope.on_outlife               = true
            // $scope.on_owner_one = true
            $scope.on_owner_two = true
            // $scope.on_packing_size = true
            $scope.on_po_number                    = true
            $scope.on_project_name                 = true
            $scope.on_quantity                     = true
            $scope.on_remarks                      = true
            $scope.on_repack_size                  = true
            $scope.on_require_bulk_volume_tracking = true
            $scope.on_require_outlife_tracking     = true
            $scope.on_sds                          = true
            $scope.on_serial                       = true
            $scope.on_statutory_body               = true
            $scope.on_storage_area                 = true
            $scope.on_supplier                     = true
            // $scope.on_unit_of_measure = true
            $scope.on_no_of_extension       = true
            $scope.on_unit_packing_value    = true
            $scope.on_used_for_td_expt_only = true
        } else {
            $scope.on_access                          = false
            $scope.on_alert_before_expiry             = false
            $scope.on_alert_threshold_qty_lower_limit = false
            $scope.on_alert_threshold_qty_upper_limit = false
            $scope.on_barcode_number                  = false
            $scope.on_batch                           = false
            $scope.on_brand                           = true
            $scope.on_cas                             = false
            $scope.on_category_selection              = false
            $scope.on_coc_coa_mill_cert               = false
            $scope.on_cost_per_unit                   = false
            $scope.on_date_in                         = false
            $scope.on_disposed_after                  = false
            $scope.on_date_of_expiry                  = true
            $scope.on_date_of_manufacture             = false
            $scope.on_date_of_shipment                = false
            $scope.on_department                      = true
            $scope.on_disposal_certificate            = false
            $scope.on_euc_material                    = false
            $scope.on_extended_expiry                 = false
            $scope.on_extended_qc_result              = false
            $scope.on_extended_qc_status              = false
            $scope.on_fm_1202                         = false
            $scope.on_housing                         = false
            $scope.on_housing_type                    = true
            $scope.on_iqc_result                      = false
            $scope.on_iqc_status                      = false
            $scope.on_material_product_id             = false
            $scope.on_material_product_type           = false
            $scope.on_outlife                         = false
            $scope.on_owner_one                       = false
            $scope.on_owner_two                       = true
            $scope.on_packing_size                    = false
            $scope.on_po_number                       = false
            $scope.on_project_name                    = false
            $scope.on_quantity                        = true
            $scope.on_remarks                         = false
            $scope.on_repack_size                     = false
            $scope.on_require_bulk_volume_tracking    = false
            $scope.on_require_outlife_tracking        = false
            $scope.on_sds                             = false
            $scope.on_serial                          = false
            $scope.on_statutory_body                  = false
            $scope.on_storage_area                    = true
            $scope.on_supplier                        = false
            $scope.on_unit_of_measure                 = false
            $scope.on_unit_packing_value              = true
            $scope.on_used_for_td_expt_only           = true
            $scope.on_no_of_extension                 = false
        }
    }

    // ==== Get Data form DB ====
    $scope.get_material_products = function () {
        $http({
            method: 'get',
            url: material_products_url,
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            $scope.material_products_data = $scope.material_products.data;
            setTimeout(() => {
                $(".loader").hide()
            }, 100);
        }, function (response) {
            Message('danger', response.data.message);
        });

    }
    $scope.get_material_products();

    // ====== Edit & Duplicate Data DB ====

    $scope.editOrDuplicate = function (wizard_mode, id, batch_id, is_parent) {
        window.location.replace(`${app_URL}/search-or-add/material-product/form-one/${wizard_mode}/${id}/batch/${batch_id}/${is_parent != undefined ? is_parent : ''}`);
    }

    // ====== Delete Data DB ====
    $scope.delete_material_product = function (id) {
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
                $http({
                    method: 'POST',
                    url: delete_material_products_url + "/" + id,
                }).then(function (response) {
                    $scope.data = response.data;
                    $scope.get_material_products();
                    Message('success', response.data.message);
                }, function (response) {
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
                $http({
                    method: 'POST',
                    url: delete_material_products_batch_url + "/" + id,
                }).then(function (response) {
                    $scope.data = response.data;
                    $scope.get_material_products();
                    Message('success', response.data.message);
                }, function (response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
        });
    }

    $scope.view_material_product = function (row) {
        viewParentBatch(row.id) 
        $scope.view_material_product_data = [
            { name: "Category Selection", item: row.category_selection == 'in_house' ? 'In-house Product' : 'Material' },
            { name: 'Item description', item: row.item_description },
            { name: 'Unit Packing size', item: row.unit_packing_value },
            { name: 'Statutory body', item: row.batches[0].statutory_body !== null ? row.batches[0].statutory_body.name : '' },
            { name: 'Alert threshold Qty (upper limit)', item: row.alert_threshold_qty_upper_limit },
            { name: 'Alert threshold Qty (lower limit) ', item: row.alert_threshold_qty_lower_limit },
            { name: 'Alert before expiry (in weeks)', item: row.alert_before_expiry },
        ]
    }

    $scope.view_batch_details = function (id) {
        viewBatch(id)
    }

    //  ===== Pagination & Filters ====
    $scope.next_Prev_page = function (params) {
            if ($scope.advance_search_status == true && $scope.sort_by_payload == true) {
             var payload_data = $scope.sort_by_payload_data;
            }else if ($scope.advance_search_status == true) {
            var payload_data = $scope.filter_data;
            }else if ($scope.advance_search_pre_saved == true) {
                var payload_data = { advanced_search: $scope.advance_search_pre_saved_data }
            }else if ($scope.sort_by_payload == true) {
                var payload_data = $scope.sort_by_payload_data
            } else {
                var payload_data = { Empty: "0000" }
            }

        $http({
            method: 'post',
            url: params,
            data: payload_data
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function (response) {
            Message('danger', response.data.message);
        });
    }

    $scope.sort_by = function (name, type,advanced_search) {
        $scope.filter_status = true
        $scope.sort_by_payload = false;
        if (advanced_search === undefined) {
            $scope.filler_function();
            var payload_data = $scope.filter_data
            $scope.advance_search_status = true
        } else {
            $scope.advance_search_pre_saved = true
            $scope.advance_search_pre_saved_data = advanced_search
            var payload_data = $scope.advanced_filter
        }
        if (type == 'saved_search') {
            var payload_data = {
                advanced_search: advanced_search
            }
        }

        Object.keys(payload_data.advanced_search).map((item) => {
            if (
                item == "date_in" || item == "date_of_expiry" || item == "date_of_manufacture" || item == "date_of_shipment" || item == "disposed_after"
            ) {
                payload_data.advanced_search[item].startDate = moment(payload_data.advanced_search[item].startDate).format('YYYY-MM-DD')
                payload_data.advanced_search[item].endDate = moment(payload_data.advanced_search[item].endDate).format('YYYY-MM-DD')
            }
        })
        if(name=='item_description'){
            $('#sort_value').val(type);
        }
        $scope.sort_by_payload = true;
       if(name=='item_description'){
            $scope.sort_by_payload_data = {
                sort_by: {
                    col_name: name,
                    order_type: type,
                    type:'',
                    filter:payload_data
                }
            }
        }else{
            $scope.sort_by_payload_data = {
                sort_by: {
                    col_name: name,
                    order_type: type,
                    type:$('#sort_value').val(),
                    filter:payload_data
                }
            }
        }
        $scope.sort_by_payload = true;
        $http({
            method: 'post',
            url: material_products_url,
            data:$scope.sort_by_payload_data,
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();

        }, function (response) {
            Message('danger', response.data.message);
        });
    }

    $scope.search_barcode_number = function () {
        if ($scope.barcode_number === undefined) {
            return false
        }
        if ($scope.barcode_number === null) {
            return false
        }
        $http({
            method: 'post',
            url: material_products_url,
            data: {
                filters: $scope.barcode_number
            }
        }).then(function (response) {

            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();

            setTimeout(() => {
                $(".loader").hide()
            }, 100);

        }, function (response) {
            Message('danger', response.data.message);
        });

    }

    $scope.removeDirectDetectRow = (index) => {
        $scope.directDeduct.splice(index, 1)
    }
    $scope.removeDeductTrackUsageRow = (index) => {
        $scope.deductTrackUsage.splice(index, 1)
    }


    $scope.clear_advanced_filter = () => {
        $scope.advanced_filter.owners = {}
        $scope.advanced_filter = {}
        $scope.get_material_products()
    }

     $scope.export = (advanced_search, type) => {
        if ($scope.advance_search_status == true && $scope.sort_by_payload == true) {
             var payload_data = $scope.sort_by_payload_data;
            }else if ($scope.advance_search_status == true) {
            var payload_data = $scope.filter_data;
            }else if ($scope.advance_search_pre_saved == true) {
                var payload_data = { advanced_search: $scope.advance_search_pre_saved_data }
            }else if ($scope.sort_by_payload == true) {
                var payload_data = $scope.sort_by_payload_data
            } else {
                var payload_data = { Empty: "0000" }
            }
     
         $http({
                method: 'post',
                  url:material_products_export,
                data: payload_data,
                responseType: 'blob'
            }).then(function (response) {
            if(response.data.type=="text/html"){
            Message('danger','Permission Denied ! Contact your admin');
            }else{
            var blob = new Blob([response.data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'banner.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            }  
            }, function (response) {
               
                Message('danger','Please search to Export.');
            });
     }
      $scope.document_zip = (advanced_search, type) => {
        if ($scope.advance_search_status == true && $scope.sort_by_payload == true) {
             var payload_data1 = $scope.sort_by_payload_data;
            }else if ($scope.advance_search_status == true) {
            var payload_data1 = $scope.filter_data;
            }else if ($scope.advance_search_pre_saved == true) {
                var payload_data1 = { advanced_search: $scope.advance_search_pre_saved_data }
            }else if ($scope.sort_by_payload == true) {
                var payload_data1 = $scope.sort_by_payload_data
            } else {
                var payload_data1 = { Empty: "0000" }
            }
     
         $http({
                method: 'post',
                  url:material_products_document,
                data: payload_data1,
                responseType: 'blob'
            }).then(function (response) {
            if(response.data.type=="text/html"){
            Message('danger','Permission Denied ! Contact your admin');
            }else{
            var blob = new Blob([response.data], { type: 'application/zip' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'document.zip';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            }  
            }, function (response) {
               if(response.status==402){
                                 Message('danger','Please search to Download Document.');
               }else if(response.status==401){
                 Message('danger','Failed to generate zip file as the file size is too large.');
               }else{

                  Message('danger','Failed to generate zip file or zip file is empty.');
               }
               

            });
     }
    $scope.search_advanced_mode = (advanced_search, type) => {
             
        $scope.filter_status = true
        $scope.sort_by_payload = false;
        if (advanced_search === undefined) {
            $scope.filler_function();
            var payload_data = $scope.filter_data
            $scope.advance_search_status = true
        } else {
            $scope.advance_search_pre_saved = true
            $scope.advance_search_pre_saved_data = advanced_search
            var payload_data = $scope.advanced_filter
        }
        if (type == 'saved_search') {
            var payload_data = {
                advanced_search: advanced_search
            }
        }

        Object.keys(payload_data.advanced_search).map((item) => {
            if (
                item == "date_in" || item == "date_of_expiry" || item == "date_of_manufacture" || item == "date_of_shipment" || item == "disposed_after"
            ) {
                payload_data.advanced_search[item].startDate = moment(payload_data.advanced_search[item].startDate).format('YYYY-MM-DD')
                payload_data.advanced_search[item].endDate = moment(payload_data.advanced_search[item].endDate).format('YYYY-MM-DD')
            }
        })
        
       
        $http({
            method: 'post',
            url: material_products_url,
            data: payload_data
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();

            $('#advance-search-ng-modal').modal('hide');
            if ($scope.view_my_saved_search_model == true) {
                $('#saved-search-ng-modal').modal('hide');
            }
        }, function (response) {
            Message('danger', response.data.message);
        });
    }
    $scope.resetBarCode = () => {
        $scope.barcode_number = ''
    }
    $scope.reset_bulk_search = function () {
        location.reload()
        // $scope.get_material_products();
        // $scope.filter_status = false;
        // $scope.advance_search_status = false;
        // $scope.sort_by_payload = false;

        // $scope.barcode_number = ''

        // // ====Bulk Search Rest====
        // $scope.filter = ""
        // // ====Bulk Search Rest===
        // delete $scope.filter_data
        // $scope.clear_advanced_filter()
    }

    $scope.filler_function = () => {
        if ($scope.filter_status == true) {
            $scope.filter_data = {
                advanced_search: $scope.advanced_filter
            }
        } else {
            $scope.filter_data = {}
        }
    }
    $scope.filler_function();

    $scope.save_search_title = () => {
        if ($scope.search_title === undefined) {
            Message('danger', "Search Title is Required !");
            return false
        }

        $http({
            method: 'post',
            url: get_save_search_url,
            data: { data: $scope.advanced_filter, search_title: $scope.search_title }
        }).then(function (response) {
            $scope.material_products = response.data.data;
            Message('success', response.data.message);
            $scope.search_title = ''
            $('#save-search-name').modal('hide');
            $('#saveThisSearch').prop('checked', false);
        }, function (response) {
            Message('danger', response.data.errors.search_title[0]);
        });
    }

    $scope.view_my_saved_search = () => {
        $scope.view_my_saved_search_model = true
        $("#saved-search-ng-modal").modal('show')
        $http({
            method: 'get',
            url: get_save_search_url,
        }).then(function (response) {
            $scope.view_my_saved_search_list = response.data.data;
        });
    }
    $scope.removeSearchRecord = (id) => {
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
                $http({
                    method: 'DELETE',
                    url: get_save_search_url + "/" + id
                }).then(function (response) {
                    $http({
                        method: 'get',
                        url: get_save_search_url,
                    }).then(function (response) {
                        $scope.view_my_saved_search_list = response.data.data;
                    });
                    Message('success', response.data.message);
                });
            }
        });
    }

    $http.get(get_masters).then((res) => {
        $scope.MasterData = res.data
        // $scope.myDropdownOptions = [{
        //     id: "S",
        //     label: "Standard"
        // }, {
        //     id: "I",
        //     label: "Intermediate"
        // }, {
        //     id: "B",
        //     label: "Best available"
        // }];

        $scope.owners = $scope.MasterData.owners
        $scope.owners =  $scope.owners.map((user) => {
            return {
                id: user.id,
                label: user.alias_name
            }
        })

        $scope.advanced_filter_owners = [];

        $scope.advanced_filter.owners = $scope.advanced_filter_owners
    });

    $scope.Transfers = (id, quantity) => {
        $scope.TransfersBatch = null
        $http.get(`${get_batch}/${id}`).then((response) => {
            $scope.TransfersBatch            = response.data
            $scope.TransfersBatchOwners      = $scope.owners;
            $scope.TransfersBatchOwnersModel = []

            $scope.TransfersBatchOwners.map((user,i) => {
                $scope.TransfersBatch.batch_owners.map((batch_user) => {
                    if(user.id == batch_user.user_id) {
                        $scope.TransfersBatchOwnersModel.push($scope.TransfersBatchOwners[i])
                    }
                })
            })
            $scope.TransfersBatchMaxQuantity = response.data.quantity
            $('#Transfers').modal('show');
        });
    }
    $scope.transferBatch = () => {
        if ($scope.TransfersBatch.quantity == '' || $scope.TransfersBatch.storage_area == '' || $scope.TransfersBatch.housing_type == '' || $scope.TransfersBatch.housing == '' || $scope.TransfersBatch.owners == ''  || $scope.TransfersBatch.owners.length == 0 ) {
            Message('danger', "All fields is Required !");
            return false
        }
        if ($scope.TransfersBatch.quantity == null || $scope.TransfersBatch.storage_area == null || $scope.TransfersBatch.housing_type == null || $scope.TransfersBatch.housing == null || $scope.TransfersBatch.owners == undefined || $scope.TransfersBatch.owners == null) {
            Message('danger', "All fields is Required !");
            return false
        }
        var data = {
            id                 : $scope.TransfersBatch.id,
            material_product_id: $scope.TransfersBatch.material_product_id,
            quantity           : $scope.TransfersBatch.quantity,
            storage_area       : $scope.TransfersBatch.storage_area,
            housing            : $scope.TransfersBatch.housing,
            housing_type       : $scope.TransfersBatch.housing_type,
            owners             : $scope.TransfersBatchOwnersModel,
        }

        $http.post(transfer_batch, data ).then((response) => {
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
                    text: "Yes, Delete",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $scope.TransfersBatch.quantity = ''
                $scope.TransfersBatch.storage_area = ''
                $scope.TransfersBatch.housing_type = ''
                $scope.TransfersBatch.housing = ''
                $scope.TransfersBatch.owners = ''
                $scope.$apply()
            }
        });
    }

    // Repack And Transfer
    $scope.CurrentDate = new Date();

    $scope.RepackTransfers = (type, batch, row) => {
        switch (type) {
            case "view":
                $("#RepackTransfers").modal("show");
                $scope.RepackTransfer = batch;
                $scope.RepackTransferPackSize = row.unit_packing_value
                $scope.RepackTransferQty = batch.quantity
                $scope.RepackTransferMeasure = row.unit_of_measure.name
                const CurrentAccessed = JSON.parse($scope.RepackTransfer.access);
                $scope.CurrentAccessed = CurrentAccessed.join()

                $scope.RepackTransfersBatchOwners      = $scope.owners;
                    $scope.RepackTransfersBatchOwnersModel = []

                    $scope.RepackTransfersBatchOwners.map((user,i) => {
                        $scope.RepackTransfer.batch_owners.map((batch_user) => {
                            if(user.id == batch_user.user_id) {
                                $scope.RepackTransfersBatchOwnersModel.push($scope.RepackTransfersBatchOwners[i])
                            }
                        })
                    })

                break;
            case "store":
                if ($scope.RepackTransfer.RepackQuantity === null || $scope.RepackTransfer.RepackQuantity === undefined) {
                    Message('danger', "Input Used amt (L) is Required !");
                    return false;
                }
                if ($scope.RepackTransfer.new_unit_packing_value == '' || $scope.RepackTransfer.quantity == '' || $scope.RepackTransfer.storage_area == '' || $scope.RepackTransfer.housing_type == '' || $scope.RepackTransfer.housing == '') {
                    Message('danger', "All fields is Required !");
                    return false
                }
                if ($scope.RepackTransfer.new_unit_packing_value == null || $scope.RepackTransfer.quantity == null || $scope.RepackTransfer.storage_area == null || $scope.RepackTransfer.housing_type == null || $scope.RepackTransfer.housing == null) {
                    Message('danger', "All fields is Required !");
                    return false
                }
                var data = {
                    "id"                    : $scope.RepackTransfer.id,
                    "material_product_id"   : $scope.RepackTransfer.material_product_id,
                    "AutoCalQty"            : $scope.RepackTransfer.AutoCalQty,
                    "new_unit_packing_value": $scope.RepackTransfer.new_unit_packing_value,
                    "storage_area"          : $scope.RepackTransfer.storage_area,
                    "housing_type"          : $scope.RepackTransfer.housing_type,
                    "housing"               : $scope.RepackTransfer.housing,
                    "RemainQuantity"        : $scope.RepackTransfer.RemainQuantity,
                    "owners"                : $scope.RepackTransfersBatchOwnersModel,
                }
                $http.post(repack_batch, data).then((response) => {
                    $scope.get_material_products();
                    Message(response.data.status == true ? 'success' : 'danger', response.data.message);
                    $('#RepackTransfers').modal('hide');
                });
                break;
            case "clear":
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
                            text: "Yes, Delete",
                            value: true,
                            visible: true,
                            className: "btn btn-danger rounded-pill",
                            closeModal: true
                        }
                    },
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $scope.RepackTransfer.quantity = ''
                        $scope.RepackTransfer.storage_area = ''
                        $scope.RepackTransfer.housing_type = ''
                        $scope.RepackTransfer.housing = ''
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
        window.location.href = `${APP_URL}/print-label/${id}`
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
            if (isConfirm) {
                window.location.href = `${APP_URL}/print-label/${id}`
            }
        });
    }
    // New Repack Outlife eFlow
    $scope.repack_outlife_table = [];
    $scope.disable_repack_outlife = false

    $scope.RepackOutlife = (batch, unit_of_measure) => {

        if (batch.updated_outlife != null) {
            var initial_day = batch.updated_outlife
        } else {
            var initial_day = batch.outlife + " Days"
        }

        $scope.repack_outlife_unit_of_measure = unit_of_measure.name
        $scope.repack_outlife_days            = initial_day
        $scope.currentBatchId                 = batch.id
        $scope.currentBatch                   = batch
        // end_of_batch
        $http.get(`search-or-add/repack-batch/${batch.id}`).then((response) => {
            $scope.repack_outlife_table.length = 0;
            const RepackData = response.data
            if (RepackData.repack_outlife.length !== 0) {
                RepackData.repack_outlife.forEach(element => {
                    $scope.repack_outlife_table.push(
                        {
                            id: element.id,
                            draw_in: {
                                status: element.draw_in,
                                time_stamp: element.draw_in_time_stamp
                            },
                            draw_out: {
                                status: element.draw_out,
                                time_stamp: element.draw_out_time_stamp
                            },
                            last_access: JSON.parse(RepackData.access),
                            initial_amount: element.input_repack_amount,
                            old_input_repack_amount: element.old_input_repack_amount,
                            initial_count: RepackData.outlife,
                            repack_amount: element.input_repack_amount,
                            balance_amount: element.remain_amount,
                            repack_size: element.repack_size,
                            quantity: element.quantity,
                            draw_in_disabled: element.draw_in_disabled,
                            remaining_days: element.remain_days,
                            remaining_days_seconds: element.remaining_days_seconds,
                            barcode_number: RepackData.barcode_number,
                            total_quantity: Number(RepackData.total_quantity),
                            draw_in_last_access:element.draw_in_last_access,
                            draw_out_last_access:element.draw_out_last_access,
                        }
                    );
                })
            }
          
            $('#RepackOutlife').modal('show');
        })
    }

    $scope.next_draw = false
    $scope.saveRepackOutlife = () => {

        $http.post(`store-repack-batch/${$scope.currentBatchId}`, { repack_id: localStorage.getItem('repack_outlife_id'), data: $scope.repack_outlife_table }).then((response) => {
                $scope.next_draw = response.data.new_draw_in
                $http.get(`search-or-add/repack-batch/${$scope.currentBatchId}`).then((response) => {
                    const RepackData = response.data
                    $scope.repack_outlife_table.length = 0;
                    if (RepackData.repack_outlife.length !== 0) {
                        RepackData.repack_outlife.forEach(element => {
                            $scope.repack_outlife_table.push(
                                {
                                    id: element.id,
                                    draw_in: {
                                        status: element.draw_in,
                                        time_stamp: element.draw_in_time_stamp
                                    },
                                    draw_out: {
                                        status: element.draw_out,
                                        time_stamp: element.draw_out_time_stamp
                                    },
                                    last_access: JSON.parse(RepackData.access),
                                    initial_amount: RepackData.unit_packing_value,
                                    initial_count: RepackData.outlife,
                                    repack_amount: element.input_repack_amount,
                                    old_input_repack_amount: element.old_input_repack_amount,
                                    balance_amount: element.remain_amount,
                                    repack_size: element.repack_size,
                                    qty_cut: element.qty_cut,
                                    draw_in_disabled: element.draw_in_disabled,
                                    remaining_days: element.remain_days,
                                    remaining_days_seconds: element.remaining_days_seconds,
                                    barcode_number: RepackData.barcode_number,
                                    total_quantity: Number(RepackData.total_quantity),
                                    draw_in_last_access:element.draw_in_last_access,
                                    draw_out_last_access:element.draw_out_last_access,
                                }
                            );
                        })
                    }
                    Message('success', "Repack Outlife Saved !")
                })
                if ($('#exportLogCheckBox').is(':checked')) {
                    location.replace(`export-repack-batch/${$scope.currentBatchId}`);
                    $('#exportLogCheckBox').prop('checked', false)
                }
                $scope.get_material_products();
                $('#RepackOutlife').modal('hide');
            })
    }
    $scope.duplicateThisBatch = (id) => {
        $http.get('search-or-add/duplicate-batch/' + id).then((res) => {
            window.location.replace(`search-or-add/material-product/form-one/${res.data.wizard_mode}/${res.data.material_product_id}/batch/${res.data.batch_id}`);
        })
    }
    $scope.changeReadStatus = (id) => {
        $http.post(change_batch_read_status + "/" + id).then((res) => {
          
            if(res.data.status === 200) { 
                $scope.get_material_products()
                getNotificationCount()
            } else {
                Message('danger', 'Permission Denied ! Contact your admin');
            }
        })
    }


    $scope.extension = (batch) => {
        $scope.batch = batch
        //$scope.batch.date_of_expiry = moment(batch.date_of_expiry).format('YYYY-DD-MM')
        $('#Extensionmodal').modal('show');
    }

    setTimeout(() => {
        if ($scope.extend_status_batch_id !== 'null' && $scope.extend_status_batch_id != undefined) {
            $http.get(APP_URL + '/get-extend-expiry' + "/" + $scope.extend_status_batch_id).then((res) => {
                if (res.data != 404) {
                    $scope.batch = res.data
                    $('#Extensionmodal').modal('show');
                }
            })
        }
    }, 500);

    $scope.dispose = (batch) => {
        $scope.batch = batch
        $('#disposalModal').modal('show');
    }
    setTimeout(() => {
        if ($scope.disposal_status_batch_id !== 'null' && $scope.disposal_status_batch_id != undefined) {
            $http.get(APP_URL + '/get-disposal-expiry' + "/" + $scope.disposal_status_batch_id).then((res) => {
                if (res.data != 404) {
                    $scope.batch = res.data
                    $('#disposalModal').modal('show');
                }
            })
        }
    }, 500);

    $scope.directDeduct = []
    $scope.deductTrackUsage = []
    $scope.deductTrackOutlife = [];

    // ============ TO Reconciliate PROCESS ========
    $scope.toReconciliate = (row,batch) => {
        // console.log(batch)   
        $scope.item_description = row.item_description
        $scope.brand            = batch.brand
        $scope.batch_serial     = `${batch.batch} / ${batch.serial}`
        $('#reconciliation-modal').modal('show')
        $scope.ReconciliateId = batch.id
        $scope.ReconciliateSystemStock = Number(batch.quantity)
    }
    $scope.ReconciliateSave = () => {
        $http.post(`${APP_URL}/reconciliation/update/${$scope.ReconciliateId}`, $scope.Reconciliate).then((res) => {
            $scope.Reconciliate.PhysicalStock = '';
            $scope.Reconciliate.Remarks = '';
            $('#reconciliation-modal').modal('hide');
            Message('success', 'Reconciliation Success !');
            $scope.get_material_products();
        })
    }

    $scope.exportExcel = (batch_id, pageName) => {
        location.href = `${app_URL}/reports/deduct-track-outlife/download/${batch_id}`
    }
    $scope.setEndOfBatch = (id) => {
        $http.get(APP_URL + '/change-end-of-batch' + "/" + id).then((res) => {
            if (res.data != 404) {
                $('#RepackOutlife').modal('hide');
                Message('success', 'Batch to be ended!');
                location.reload()
            }
        })
    }
});
